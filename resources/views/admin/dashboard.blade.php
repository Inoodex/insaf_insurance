@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="pt-5 pb-8">
        <!-- Minimal Dashboard Header -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-xl font-bold uppercase tracking-wider text-slate-800 dark:text-white">Insurance Overview</h2>
            </div>
        </div>

        <!-- Insurance Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-12">
            <!-- Total Students -->
            <div class="panel h-full hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between"
                style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.12), rgba(6, 182, 212, 0.08)); border: 1px solid rgba(59, 130, 246, 0.25);">
                <div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-extrabold tracking-tight" style="color: #2563eb;">
                                {{ number_format($stats['total_students']) }}</div>
                            <div class="text-xs font-bold uppercase tracking-widest mt-1" style="color: #3b82f6;">Total
                                Students</div>
                        </div>
                        <div class="p-3 rounded-xl border"
                            style="background-color: rgba(37, 99, 235, 0.1); color: #2563eb; border-color: rgba(37, 99, 235, 0.2);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-4 flex items-center justify-between"
                    style="border-top: 1px solid rgba(59, 130, 246, 0.15);">
                    <span class="text-[11px] font-medium" style="color: rgba(37, 99, 235, 0.8);">Registered members</span>
                    <a href="{{ route('admin.students.index') }}"
                        class="text-[11px] font-bold uppercase tracking-wider flex items-center gap-1 hover:underline"
                        style="color: #2563eb;">
                        View All <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" class="hover:translate-x-0.5 transition-transform">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Total Applications -->
            <div class="panel h-full hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between"
                style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.12), rgba(168, 85, 247, 0.08)); border: 1px solid rgba(139, 92, 246, 0.25);">
                <div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-extrabold tracking-tight" style="color: #7c3aed;">
                                {{ number_format($stats['total_applications']) }}</div>
                            <div class="text-xs font-bold uppercase tracking-widest mt-1" style="color: #8b5cf6;">
                                Applications</div>
                        </div>
                        <div class="p-3 rounded-xl border"
                            style="background-color: rgba(124, 58, 237, 0.1); color: #7c3aed; border-color: rgba(124, 58, 237, 0.2);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                    </div>
                    @if ($stats['pending_applications'] > 0)
                        <div class="mt-3">
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider"
                                style="background-color: rgba(124, 58, 237, 0.15); color: #7c3aed; border: 1px solid rgba(124, 58, 237, 0.25);">
                                <span class="h-1.5 w-1.5 rounded-full bg-purple-500 animate-pulse"></span>
                                {{ $stats['pending_applications'] }} Pending Review
                            </span>
                        </div>
                    @endif
                </div>
                <div class="mt-6 pt-4 flex items-center justify-between"
                    style="border-top: 1px solid rgba(124, 58, 237, 0.15);">
                    <span class="text-[11px] font-medium" style="color: rgba(139, 92, 246, 0.8);">Total submissions</span>
                    <a href="{{ route('admin.applications.index') }}"
                        class="text-[11px] font-bold uppercase tracking-wider flex items-center gap-1 hover:underline"
                        style="color: #7c3aed;">
                        Manage <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" class="hover:translate-x-0.5 transition-transform">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Total Claims -->
            <div class="panel h-full hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between"
                style="background: linear-gradient(135deg, rgba(249, 115, 22, 0.12), rgba(251, 146, 60, 0.08)); border: 1px solid rgba(249, 115, 22, 0.25);">
                <div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-extrabold tracking-tight" style="color: #ea580c;">
                                {{ number_format($stats['total_claims']) }}</div>
                            <div class="text-xs font-bold uppercase tracking-widest mt-1" style="color: #f97316;">Total
                                Claims</div>
                        </div>
                        <div class="p-3 rounded-xl border"
                            style="background-color: rgba(234, 88, 12, 0.1); color: #ea580c; border-color: rgba(234, 88, 12, 0.2);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                    </div>
                    @if ($stats['pending_claims'] > 0)
                        <div class="mt-3">
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider animate-pulse"
                                style="background-color: rgba(234, 88, 12, 0.15); color: #ea580c; border: 1px solid rgba(234, 88, 12, 0.25);">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                {{ $stats['pending_claims'] }} Pending
                            </span>
                        </div>
                    @endif
                </div>
                <div class="mt-6 pt-4 flex items-center justify-between"
                    style="border-top: 1px solid rgba(234, 88, 12, 0.15);">
                    <span class="text-[11px] font-medium" style="color: rgba(249, 115, 22, 0.8);">Claims progress</span>
                    <a href="{{ route('admin.claims.index') }}"
                        class="text-[11px] font-bold uppercase tracking-wider flex items-center gap-1 hover:underline"
                        style="color: #ea580c;">
                        Process <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" class="hover:translate-x-0.5 transition-transform">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        @if (auth()->user()->hasRole('admin'))
            <!-- Section Title: Administration -->
            <div class="flex items-center gap-3 mb-6 mt-12">
                <span class="h-6 w-1 rounded-full bg-teal-600/70"></span>
                <h2 class="text-lg font-bold uppercase tracking-wider text-slate-800 dark:text-white">Administration
                    Settings</h2>
            </div>

            <!-- Administration Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- System Users -->
                <div class="panel h-full hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between"
                    style="background: linear-gradient(135deg, rgba(13, 148, 136, 0.12), rgba(16, 185, 129, 0.08)); border: 1px solid rgba(13, 148, 136, 0.25);">
                    <div>
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-3xl font-extrabold tracking-tight" style="color: #0d9488;">
                                    {{ number_format($stats['total_users']) }}</div>
                                <div class="text-xs font-bold uppercase tracking-widest mt-1" style="color: #0f766e;">
                                    System Users</div>
                            </div>
                            <div class="p-3 rounded-xl border"
                                style="background-color: rgba(13, 148, 136, 0.1); color: #0d9488; border-color: rgba(13, 148, 136, 0.2);">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <polyline points="17 11 19 13 23 9"></polyline>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 flex items-center justify-between"
                        style="border-top: 1px solid rgba(13, 148, 136, 0.15);">
                        <span class="text-[11px] font-medium" style="color: rgba(13, 148, 136, 0.8);">Authorized
                            accounts</span>
                        <a href="{{ route('tyro-dashboard.users.index') }}"
                            class="text-[11px] font-bold uppercase tracking-wider flex items-center gap-1 hover:underline"
                            style="color: #0d9488;">
                            Manage Users <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5"
                                class="hover:translate-x-0.5 transition-transform">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Roles -->
                <div class="panel h-full hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between"
                    style="background: linear-gradient(135deg, rgba(225, 29, 72, 0.12), rgba(244, 63, 94, 0.08)); border: 1px solid rgba(225, 29, 72, 0.25);">
                    <div>
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-3xl font-extrabold tracking-tight" style="color: #e11d48;">
                                    {{ number_format($stats['total_roles']) }}</div>
                                <div class="text-xs font-bold uppercase tracking-widest mt-1" style="color: #f43f5e;">
                                    Active Roles</div>
                            </div>
                            <div class="p-3 rounded-xl border"
                                style="background-color: rgba(225, 29, 72, 0.1); color: #e11d48; border-color: rgba(225, 29, 72, 0.2);">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 flex items-center justify-between"
                        style="border-top: 1px solid rgba(225, 29, 72, 0.15);">
                        <span class="text-[11px] font-medium" style="color: rgba(225, 29, 72, 0.8);">Access groups</span>
                        <a href="{{ route('tyro-dashboard.roles.index') }}"
                            class="text-[11px] font-bold uppercase tracking-wider flex items-center gap-1 hover:underline"
                            style="color: #e11d48;">
                            Configure <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5"
                                class="hover:translate-x-0.5 transition-transform">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Privileges -->
                <!-- <div class="panel h-full hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between"
                         style="background: linear-gradient(135deg, rgba(79, 70, 229, 0.12), rgba(236, 72, 153, 0.08)); border: 1px solid rgba(79, 70, 229, 0.25);">
                        <div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-3xl font-extrabold tracking-tight" style="color: #4f46e5;">{{ number_format($stats['total_privileges']) }}</div>
                                    <div class="text-xs font-bold uppercase tracking-widest mt-1" style="color: #6366f1;">Privileges</div>
                                </div>
                                <div class="p-3 rounded-xl border" style="background-color: rgba(79, 70, 229, 0.1); color: #4f46e5; border-color: rgba(79, 70, 229, 0.2);">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pt-4 flex items-center justify-between" style="border-top: 1px solid rgba(79, 70, 229, 0.15);">
                            <span class="text-[11px] font-medium" style="color: rgba(79, 70, 229, 0.8);">Security permissions</span>
                            <a href="{{ route('tyro-dashboard.privileges.index') }}" class="text-[11px] font-bold uppercase tracking-wider flex items-center gap-1 hover:underline" style="color: #4f46e5;">
                                Security Rules <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="hover:translate-x-0.5 transition-transform"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </div> -->
            </div>
        @endif
    </div>
@endsection
