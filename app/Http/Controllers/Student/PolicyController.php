<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\InsuranceApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PolicyController extends Controller
{
    public function show(InsuranceApplication $application)
    {
        // Ensure student can only view their own policies
        if ($application->student_id !== Auth::guard('student')->id()) {
            abort(403);
        }

        $application->load(['plan', 'benefitCoverages']);
        return view('student.policies.show', compact('application'));
    }

    public function finance(InsuranceApplication $application)
    {
        if ($application->student_id !== Auth::guard('student')->id()) {
            abort(403);
        }

        return view('student.policies.finance', compact('application'));
    }

    public function download(InsuranceApplication $application)
    {
        if ($application->student_id !== Auth::guard('student')->id()) {
            abort(403);
        }

        $application->load(['student', 'plan', 'benefitCoverages']);
        
        $pdf = Pdf::loadView('student.policies.pdf', compact('application'));
        
        return $pdf->download('Policy-' . $application->policy_number . '.pdf');
    }
}
