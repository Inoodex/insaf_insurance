<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        return view('student.profile', compact('student'));
    }

    public function updateAddress(Request $request)
    {
        $student = Auth::guard('student')->user();
        
        $validated = $request->validate([
            'institute_address' => ['required', 'string', 'max:500'],
            'address_2' => ['nullable', 'string', 'max:500'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'city' => ['nullable', 'string', 'max:100'],
            'country_of_origin' => ['required', 'string', 'max:100'],
            'country_code' => ['nullable', 'string', 'max:10'],
            'phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        $student->update($validated);

        return back()->with('success', 'Address updated successfully.')->with('form_type', 'address');
    }

    public function updateCorrespondence(Request $request)
    {
        $student = Auth::guard('student')->user();
        
        $validated = $request->validate([
            'is_company' => ['boolean'],
            'correspondence_firstname' => ['required_without:is_company', 'nullable', 'string', 'max:100'],
            'correspondence_lastname' => ['required_without:is_company', 'nullable', 'string', 'max:100'],
            'correspondence_gender' => ['nullable', 'in:male,female,other'],
            'correspondence_address_1' => ['required', 'string', 'max:500'],
            'correspondence_address_2' => ['nullable', 'string', 'max:500'],
            'correspondence_country' => ['required', 'string', 'max:100'],
            'correspondence_zip_code' => ['nullable', 'string', 'max:20'],
            'correspondence_city' => ['nullable', 'string', 'max:100'],
            'correspondence_country_code' => ['nullable', 'string', 'max:10'],
            'correspondence_phone' => ['nullable', 'string', 'max:20'],
        ]);

        $validated['is_company'] = $request->has('is_company');
        $student->update($validated);

        return back()->with('success', 'Correspondence address updated successfully.')->with('form_type', 'correspondence');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password:student'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $student = Auth::guard('student')->user();
        $student->update([
            'password' => Hash::make($request->password),
            'password_changed' => true,
            'temporary_password' => null,
        ]);

        return back()->with('success', 'Password updated successfully.')->with('form_type', 'password');
    }
}
