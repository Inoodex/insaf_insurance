@extends('admin.layouts.master')

@section('title', 'Student Profile Details')

@section('content')
    <div class="pt-5 pb-8">
        <!-- Header & Action Actions -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-xl font-semibold uppercase">Student Details: {{ $student->full_name }}</h2>
                <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Detailed profile and system configuration for student.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to List
                </a>
                <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-primary gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Edit Profile
                </a>
            </div>
        </div>

        <!-- Profile Detail Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Card -->
            <div class="lg:col-span-1 flex flex-col gap-6">
                <!-- Main Widget Panel -->
                <div class="panel text-center flex flex-col items-center p-6 relative overflow-hidden"
                     style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(99, 102, 241, 0.05)); border: 1px solid rgba(59, 130, 246, 0.15);">
                    <div class="h-24 w-24 rounded-full flex items-center justify-center text-4xl font-bold bg-indigo-600/10 text-indigo-600 dark:text-indigo-400 border-4 border-white dark:border-slate-800 shadow-md">
                        {{ strtoupper(substr($student->full_name, 0, 2)) }}
                    </div>

                    <h3 class="text-xl font-bold text-slate-800 dark:text-white mt-4">{{ $student->full_name }}</h3>
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 mb-4">{{ $student->email }}</p>

                    <div class="flex flex-wrap gap-2 justify-center mb-6">
                        @if($student->password_changed)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Active Portal
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 animate-pulse">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> Pending Login
                            </span>
                        @endif
                    </div>

                    <div class="w-full pt-6 border-t border-slate-100 dark:border-slate-800/80 flex flex-col gap-4 text-left">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400 font-medium">Passport:</span>
                            <span class="font-bold text-slate-700 dark:text-slate-300">{{ $student->passport_number }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400 font-medium">Nationality:</span>
                            <span class="font-bold text-slate-700 dark:text-slate-300">{{ $student->nationality }}</span>
                        </div>
                    </div>
                </div>

                 <!-- Account Security Settings Panel -->
                {{-- <div class="panel p-6 flex flex-col gap-4" style="border: 1px solid rgba(139, 92, 246, 0.15);">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-2">Portal Access</h4>

                    @if(!$student->password_changed && $student->temporary_password)
                        <div class="p-3 bg-amber-50 dark:bg-amber-950/20 text-amber-800 dark:text-amber-400 rounded-xl border border-amber-200/50 dark:border-amber-900/30 text-xs">
                            <div class="font-bold mb-1">Temporary Password:</div>
                            <code class="px-2 py-0.5 bg-white/80 dark:bg-slate-900 rounded font-mono font-bold text-sm block w-max select-all">{{ $student->temporary_password }}</code>
                        </div>
                    @endif

                    <form action="{{ route('admin.students.send-credentials', $student->id) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="btn btn-outline-info w-full text-xs font-bold py-2 flex items-center justify-center gap-2">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            Resend Access Email
                        </button>
                    </form>
                </div> --}}
            </div>

            <!-- Profile Info Grid -->
            <div class="lg:col-span-2 flex flex-col gap-6">
                <!-- Personal Info Panel -->
                <div class="panel p-6 flex flex-col gap-6" style="border: 1px solid rgba(226, 232, 240, 0.8);">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100 dark:border-slate-800/80">
                        <span class="h-4 w-1 rounded-full bg-blue-600"></span>
                        <h4 class="font-bold uppercase tracking-wider text-slate-800 dark:text-white text-xs">Personal Information</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Date of Birth</span>
                            <div class="text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">
                                {{ \Carbon\Carbon::parse($student->date_of_birth)->format('F d, Y') }}
                            </div>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Gender</span>
                            <div class="text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1 capitalize">
                                {{ $student->gender }}
                            </div>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Country of Origin</span>
                            <div class="text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">
                                {{ $student->country_of_origin }}
                            </div>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Phone Number</span>
                            <div class="text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">
                                {{ $student->phone_number ?: 'Not Provided' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Academic Info Panel -->
                <div class="panel p-6 flex flex-col gap-6" style="border: 1px solid rgba(226, 232, 240, 0.8);">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100 dark:border-slate-800/80">
                        <span class="h-4 w-1 rounded-full bg-purple-600"></span>
                        <h4 class="font-bold uppercase tracking-wider text-slate-800 dark:text-white text-xs">Academic & Institution Details</h4>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Institute Name</span>
                            <div class="text-sm font-bold text-slate-800 dark:text-slate-200 mt-1">
                                {{ $student->institute_name ?? 'N/A' }}
                            </div>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Institute Address</span>
                            <div class="text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1 leading-relaxed">
                                {{ $student->institute_address }}
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Zip Code</span>
                                <div class="text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">
                                    {{ $student->zip_code ?: 'N/A' }}
                                </div>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">City</span>
                                <div class="text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">
                                    {{ $student->city ?: 'N/A' }}
                                </div>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Country</span>
                                <div class="text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">
                                    {{ $student->country_code ?: 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Audit Panel -->
                {{-- <div class="panel p-6 flex flex-col gap-6" style="border: 1px solid rgba(226, 232, 240, 0.8);">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100 dark:border-slate-800/80">
                        <span class="h-4 w-1 rounded-full bg-slate-500"></span>
                        <h4 class="font-bold uppercase tracking-wider text-slate-800 dark:text-white text-xs">System Records</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs text-slate-400">
                        <div>
                            <span>Registered On:</span>
                            <span class="font-bold text-slate-600 dark:text-slate-400 block mt-1">
                                {{ $student->created_at->format('F d, Y') }}
                            </span>
                        </div>
                        <div>
                            <span>Last Updated:</span>
                            <span class="font-bold text-slate-600 dark:text-slate-400 block mt-1">
                                {{ $student->updated_at->format('F d, Y') }}
                            </span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
