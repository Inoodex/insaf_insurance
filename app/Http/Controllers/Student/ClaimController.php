<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\InsuranceApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClaimController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        $claims = $student->claims()->with('application.plan')->latest()->get();
        return view('student.claims.index', compact('claims'));
    }

    public function create(Request $request)
    {
        $student = Auth::guard('student')->user();
        $applications = $student->applications()->where('status', 'active')->with('plan')->get();
        
        $step = $request->get('step', 1);
        $selectedPolicy = $request->get('policy_id');
        $claimType = $request->get('type');

        return view('student.claims.create', compact('applications', 'step', 'selectedPolicy', 'claimType'));
    }

    public function store(Request $request)
    {
        // This would handle the final submission of the multi-step form
        // For now, let's implement the structure
        $validated = $request->validate([
            'application_id' => 'required|exists:insurance_applications,id',
            'claim_type' => 'required|string',
            'event_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'is_working' => 'required|boolean',
            'description' => 'nullable|string',
            'bank_name' => 'required|string',
            'account_holder' => 'required|string',
            'iban' => 'required|string',
            'bic_swift' => 'required|string',
        ]);

        $validated['student_id'] = Auth::guard('student')->id();
        $validated['claim_number'] = 'CLM-' . strtoupper(Str::random(8));
        $validated['status'] = 'pending';

        $claim = Claim::create($validated);

        // Handle file uploads if any
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('claims/' . $claim->claim_number, 'public');
                $claim->documents()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('student.claims.index')->with('success', 'Claim submitted successfully. Our team will review it shortly.');
    }

    public function show(Claim $claim)
    {
        if ($claim->student_id !== Auth::guard('student')->id()) {
            abort(403);
        }

        $claim->load(['application.plan', 'documents']);
        return view('student.claims.show', compact('claim'));
    }
}
