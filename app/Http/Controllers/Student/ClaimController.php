<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\ClaimDocument;
use App\Models\InsuranceApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $step = (int) $request->input('step', 1);

        // Block new claim if student has any pending/under-review claim
        $hasPending = $student->claims()->whereIn('status', ['pending', 'under_review'])->exists();
        if ($hasPending) {
            return redirect()->route('student.claims.index')
                ->with('error', 'You have a claim currently under review. You can submit a new claim once it has been processed.');
        }

        // Reset session on step 1 GET
        if ($request->isMethod('get') && $step == 1) {
            session()->forget('claim_form');
        }

        // Handle POST for steps 1-5: persist form data to session, then advance
        if ($request->isMethod('post') && $step < 6) {
            $data = $request->except(['_token', 'step']);

            if ($step == 4 && $request->hasFile('documents')) {
                $existing = session('claim_form.documents', []);
                $draftPath = 'claims/draft/' . session()->getId();
                foreach ($request->file('documents') as $file) {
                    $stored = $file->store($draftPath, 'public');
                    $existing[] = [
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $stored,
                        'file_type' => $file->getClientMimeType(),
                        'size' => $file->getSize(),
                    ];
                }
                $data['documents'] = $existing;
            }

            $sessionData = array_merge(session('claim_form', []), $data);
            session(['claim_form' => $sessionData]);

            return redirect()->route('student.claims.create', ['step' => $step + 1]);
        }

        $applications = $student->applications()->whereIn('status', ['sent', 'active'])->with('plan')->get();
        $sessionData = session('claim_form', []);
        $selectedPolicy = $sessionData['policy_id'] ?? null;
        $claimType = $sessionData['type'] ?? null;

        return view('student.claims.create', compact('applications', 'step', 'selectedPolicy', 'claimType'));
    }

    public function store(Request $request)
    {
        $student = Auth::guard('student')->user();
        $sessionData = session('claim_form', []);

        $request->validate([
            'confirm' => 'accepted',
        ], [
            'confirm.accepted' => 'Please confirm the claim details before submitting.',
        ]);

        $claim = Claim::create([
            'student_id' => $student->id,
            'application_id' => $sessionData['policy_id'] ?? null,
            'claim_number' => 'CLM-' . strtoupper(Str::random(8)),
            'claim_type' => $sessionData['type'] ?? null,
            'event_date' => $sessionData['event_date'] ?? null,
            'amount' => $sessionData['amount'] ?? 0,
            'currency' => $sessionData['currency'] ?? 'EUR',
            'is_working' => $sessionData['is_working'] ?? 0,
            'bank_name' => $sessionData['bank_name'] ?? null,
            'account_holder' => $sessionData['account_holder'] ?? null,
            'iban' => $sessionData['iban'] ?? null,
            'bic_swift' => $sessionData['bic_swift'] ?? null,
            'status' => 'pending',
        ]);

        if (!empty($sessionData['documents'])) {
            $finalDir = 'claims/' . $claim->claim_number;
            foreach ($sessionData['documents'] as $doc) {
                $newPath = $doc['file_path'];
                if (Storage::disk('public')->exists($doc['file_path'])) {
                    $newPath = $finalDir . '/' . basename($doc['file_path']);
                    Storage::disk('public')->move($doc['file_path'], $newPath);
                }
                ClaimDocument::create([
                    'claim_id' => $claim->id,
                    'file_name' => $doc['file_name'],
                    'file_path' => $newPath,
                    'file_type' => $doc['file_type'] ?? null,
                ]);
            }
        }

        session()->forget('claim_form');

        return redirect()->route('student.claims.index')->with('success', 'Claim ' . $claim->claim_number . ' submitted successfully. Our team will review it shortly.');
    }

    public function show(Claim $claim)
    {
        if ($claim->student_id != Auth::guard('student')->id()) {
            abort(403);
        }

        $claim->load(['application.plan', 'documents']);
        return view('student.claims.show', compact('claim'));
    }
}
