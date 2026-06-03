<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\EmailLog;
use App\Mail\StudentWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('passport_number', 'like', "%{$search}%");
            });
        }

        $students = $query->latest()->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'passport_number' => 'required|string|unique:students,passport_number',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'nationality' => 'required|string|max:255',
            'country_of_origin' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'institute_name' => 'required|string|max:255',
            'institute_address' => 'required|string',
        ]);

        $temporaryPassword = Str::random(10);
        $validated['password'] = Hash::make($temporaryPassword);
        $validated['temporary_password'] = $temporaryPassword;
        $validated['password_changed'] = false;

        $student = Student::create($validated);

        // Send Welcome Email
        try {
            Mail::to($student->email)->send(new StudentWelcomeMail($student, $temporaryPassword));

            EmailLog::create([
                'student_id' => $student->id,
                'user_id' => Auth::id(),
                'email_type' => 'welcome_credentials',
                'subject' => 'Welcome to Insaf Insurance - Your Login Credentials',
                'recipient_email' => $student->email,
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        } catch (\Exception $e) {
            EmailLog::create([
                'student_id' => $student->id,
                'user_id' => Auth::id(),
                'email_type' => 'welcome_credentials',
                'subject' => 'Welcome to Insaf Insurance - Your Login Credentials',
                'recipient_email' => $student->email,
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('admin.students.index')->with('success', 'Student registered and credentials sent.');
    }

    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'passport_number' => 'required|string|unique:students,passport_number,' . $student->id,
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'nationality' => 'required|string|max:255',
            'country_of_origin' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'institute_name' => 'required|string|max:255',
            'institute_address' => 'required|string',
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }

    public function sendCredentials(Student $student)
    {
        $temporaryPassword = Str::random(10);
        $student->update([
            'password' => Hash::make($temporaryPassword),
            'temporary_password' => $temporaryPassword,
            'password_changed' => false,
        ]);

        try {
            Mail::to($student->email)->send(new StudentWelcomeMail($student, $temporaryPassword));

            EmailLog::create([
                'student_id' => $student->id,
                'user_id' => Auth::id(),
                'email_type' => 'welcome_credentials',
                'subject' => 'Welcome to Insaf Insurance - Your Login Credentials',
                'recipient_email' => $student->email,
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            return back()->with('success', 'Credentials sent successfully to ' . $student->email);
        } catch (\Exception $e) {
            EmailLog::create([
                'student_id' => $student->id,
                'user_id' => Auth::id(),
                'email_type' => 'welcome_credentials',
                'subject' => 'Welcome to Insaf Insurance - Your Login Credentials',
                'recipient_email' => $student->email,
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Failed to send credentials: ' . $e->getMessage());
        }
    }
}
