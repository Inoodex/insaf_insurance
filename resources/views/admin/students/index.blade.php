@extends('admin.layouts.master')

@section('title', 'Students Management')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">Students</h2>
        <div class="flex w-full flex-wrap items-center justify-end gap-4 sm:w-auto">
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Register Student
            </a>
        </div>
    </div>

    <div class="panel mt-6">
        <div class="mb-5 flex flex-col gap-3 md:flex-row md:items-center">
            <form action="{{ route('admin.students.index') }}" method="GET"
                class="flex w-full flex-col gap-2 md:flex-row md:items-center">
                <div class="relative min-w-0 flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search Name, Email or Passport..." class="form-input ltr:pr-11 rtl:pl-11" />
                    <button type="submit"
                        class="absolute inset-y-0 flex items-center hover:text-primary ltr:right-4 rtl:left-4">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                opacity="0.5" />
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <button type="submit" class="btn btn-sm btn-primary shrink-0">Search</button>
            </form>
        </div>

        <div class="datatable">
            <div class="overflow-x-auto">
                <table class="table-hover w-full table-auto">
                    <thead>
                        <tr>
                            <th>Student Details</th>
                            <th>Passport</th>
                            {{-- <th>Nationality</th> --}}
                            <th>Institute</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>
                                    <div class="font-semibold">{{ $student->full_name }}</div>
                                    <div class="text-xs text-white-dark">{{ $student->email }}</div>
                                </td>
                                <td><div class="font-semibold">{{ $student->passport_number }}</div>
                                    <div class="text-xs text-white-dark"> {{ $student->nationality }}</div>
                                </td>
                                {{-- <td>{{ $student->nationality }}</td> --}}
                                <td>
                                    <div class="text-sm">{{ Str::limit($student->institute_name, 20) }}</div>
                                </td>
                                <td>
                                    @if ($student->password_changed)
                                        <span class="badge badge-outline-success">Active</span> 
                                    @else
                                        <span class="badge badge-outline-warning">Pending Login</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <form action="{{ route('admin.students.send-credentials', $student->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-info"
                                                title="Resend Credentials">
                                                Email Credentials
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.students.show', $student->id) }}"
                                            class="btn btn-sm btn-outline-success">View</a>
                                        <a href="{{ route('admin.students.edit', $student->id) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this student?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No students registered yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
