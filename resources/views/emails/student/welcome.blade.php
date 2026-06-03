<x-mail::message>
# Welcome, {{ $student->full_name }}!

An administrator has registered you in the Insaf Insurance system. You can now log in to view and manage your insurance applications.

**Your Login Credentials:**
- **Email:** {{ $student->email }}
- **Temporary Password:** {{ $temporaryPassword }}

<x-mail::button :url="route('student.login')">
Log In Now
</x-mail::button>

Please change your password after your first login for security purposes.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
