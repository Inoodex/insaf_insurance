<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationIssuedMail;
use App\Models\BenefitCoverage;
use App\Models\EmailLog;
use App\Models\InsuranceApplication;
use App\Models\InsurancePlan;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InsuranceApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = InsuranceApplication::with(['student', 'plan', 'admin']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('passport_number', 'like', "%{$search}%");
            })->orWhere('policy_number', 'like', "%{$search}%");
        }

        $applications = $query->latest()->paginate(15);
        return view('admin.applications.index', compact('applications'));
    }

    public function create()
    {
        $students = Student::orderBy('full_name')->get();
        $plans = InsurancePlan::where('is_active', true)->get();
        return view('admin.applications.create', compact('students', 'plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'plan_id' => 'required|exists:insurance_plans,id',
            'first_destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'premium_amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'notes' => 'nullable|string',
        ]);

        $plan = InsurancePlan::find($request->plan_id);
        
        // Calculate duration
        $start = new \DateTime($request->start_date);
        $end = new \DateTime($request->end_date);
        $duration = $start->diff($end)->days + 1;

        $validated['user_id'] = Auth::id();
        $validated['duration_days'] = $duration;
        $validated['status'] = 'draft';
        $validated['territories'] = $plan->territories;
        $validated['policy_number'] = 'ISIE-' . strtoupper(Str::random(6));

        $application = InsuranceApplication::create($validated);

        // Generate Benefit Coverages from Plan
        $benefits = [
            'medical_cover' => $plan->medical_cover_max,
            'sea_mountain_rescue' => $plan->sea_mountain_rescue_max,
            'emergency_evacuation' => $plan->emergency_evacuation_max,
            'medical_repatriation' => $plan->medical_repatriation_max,
            'repatriation_mortal_remains' => $plan->repatriation_mortal_remains_max,
            'luggage' => $plan->luggage_max,
            'accidental_death' => $plan->accidental_death_max,
            'accidental_disability' => $plan->accidental_disability_max,
            'third_party_liability' => $plan->third_party_liability_max,
        ];

        foreach ($benefits as $type => $amount) {
            BenefitCoverage::create([
                'application_id' => $application->id,
                'benefit_type' => $type,
                'max_amount' => $amount,
                'currency' => $application->currency,
                'deductible_note' => ($type === 'luggage') ? "Deductible of {$application->currency} {$plan->luggage_deductible} per claim" : null,
            ]);
        }

        return redirect()->route('admin.applications.index')->with('success', 'Insurance application created as draft.');
    }

    public function show(InsuranceApplication $application)
    {
        $application->load(['student', 'plan', 'admin', 'benefitCoverages']);
        return view('admin.applications.show', compact('application'));
    }

    public function edit(InsuranceApplication $application)
    {
        $students = Student::orderBy('full_name')->get();
        $plans = InsurancePlan::where('is_active', true)->get();
        return view('admin.applications.edit', compact('application', 'students', 'plans'));
    }

    public function update(Request $request, InsuranceApplication $application)
    {
        $validated = $request->validate([
            'first_destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'premium_amount' => 'required|numeric|min:0',
            'status' => 'required|in:draft,sent,active,expired,cancelled',
            'notes' => 'nullable|string',
        ]);

        $oldStatus = $application->status;

        // Recalculate duration if dates changed
        $start = new \DateTime($request->start_date);
        $end = new \DateTime($request->end_date);
        $duration = $start->diff($end)->days + 1;
        $validated['duration_days'] = $duration;

        // If status changed to 'sent' and no policy number, generate one
        if ($request->status === 'sent' && !$application->policy_number) {
            $validated['policy_number'] = 'ISIE-' . strtoupper(Str::random(6));
        }

        $application->update($validated);

        // On draft -> sent transition, send the policy-issued email (dedup-guarded + queued)
        if ($oldStatus !== 'sent' && $application->status === 'sent' && $application->policy_number) {
            $this->sendPolicyIssuedNotification($application);
        }

        return redirect()->route('admin.applications.index')->with('success', 'Application updated successfully.');
    }

    public function issue(InsuranceApplication $application)
    {
        if ($application->status !== 'draft') {
            return redirect()->route('admin.applications.show', $application->id)
                ->with('error', 'Only draft applications can be issued.');
        }

        $application->policy_number = $application->policy_number ?? 'ISIE-' . strtoupper(Str::random(6));
        $application->status = 'sent';
        $application->save();

        $this->sendPolicyIssuedNotification($application);

        return redirect()->route('admin.applications.show', $application->id)
            ->with('success', 'Policy ' . $application->policy_number . ' has been issued and emailed to the student.');
    }

    public function sendEmail(InsuranceApplication $application)
    {
        if (in_array($application->status, ['expired', 'cancelled'], true)) {
            return back()->with('error', 'Cannot email a policy that is ' . $application->status . '.');
        }

        $application->status = 'sent';
        $application->save();

        $this->sendPolicyIssuedNotification($application, force: true);

        return back()->with('success', 'Policy ' . $application->policy_number . ' has been issued and emailed to ' . $application->student->email . '.');
    }

    private function sendPolicyIssuedNotification(InsuranceApplication $application, bool $force = false): void
    {
        if (!$force) {
            $alreadySent = EmailLog::where('application_id', $application->id)
                ->where('email_type', 'policy_issued')
                ->where('status', 'sent')
                ->exists();

            if ($alreadySent) {
                return;
            }
        }

        $application->loadMissing(['student', 'plan', 'benefitCoverages']);

        $subject = 'Your Insurance Policy ' . $application->policy_number . ' Has Been Issued';

        try {
            Mail::to($application->student->email)
                ->send(new ApplicationIssuedMail($application));

            EmailLog::create([
                'student_id' => $application->student_id,
                'application_id' => $application->id,
                'user_id' => Auth::id(),
                'email_type' => 'policy_issued',
                'subject' => $subject,
                'recipient_email' => $application->student->email,
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        } catch (\Exception $e) {
            EmailLog::create([
                'student_id' => $application->student_id,
                'application_id' => $application->id,
                'user_id' => Auth::id(),
                'email_type' => 'policy_issued',
                'subject' => $subject,
                'recipient_email' => $application->student->email,
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }
    }

    public function markAsPaid(InsuranceApplication $application)
    {
        if ($application->paid_on) {
            return back()->with('error', 'This application is already marked as paid.');
        }

        $application->paid_on = now();
        $application->save();

        return back()->with('success', 'Application marked as paid successfully.');
    }

    public function destroy(InsuranceApplication $application)
    {
        $application->delete();
        return redirect()->route('admin.applications.index')->with('success', 'Application deleted successfully.');
    }
}
