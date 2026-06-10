<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #fff;
        }

        .nav-active {
            border-bottom: 2px solid #4A3B75;
            color: #4A3B75;
            font-weight: 600;
        }

        .btn-gradient {
            background: linear-gradient(to r, #8E79F0, #A294F9);
            color: white;
        }

        main select:not([multiple]) {
            min-height: 3rem;
            border: 1px solid #d8d3fb !important;
            border-radius: 0.875rem !important;
            background-color: #fff !important;
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M6 9l6 6 6-6' stroke='%234A3B75' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
            box-shadow: 0 10px 30px rgba(142, 121, 240, 0.12);
            color: #4A3B75 !important;
            cursor: pointer;
            padding-right: 2.75rem !important;
        }

        main select:not([multiple]):focus {
            border-color: #8E79F0 !important;
            box-shadow: 0 0 0 4px rgba(142, 121, 240, 0.16);
        }

        main select option {
            background: #fff;
            color: #4A3B75;
            font-weight: 600;
        }

        .student-option-nav {
            background: #fff !important;
            border-color: #d8d3fb !important;
            box-shadow: 0 14px 35px rgba(142, 121, 240, 0.14);
        }

        .student-option-nav a {
            color: #6b5ca9 !important;
            border: 1px solid transparent;
        }

        .student-option-nav a:hover {
            background: #f6f4ff;
            border-color: #e5e0ff;
            color: #4A3B75 !important;
        }

        .student-option-nav a.is-active {
            background: #8E79F0 !important;
            border-color: #8E79F0;
            color: #fff !important;
            box-shadow: 0 10px 24px rgba(142, 121, 240, 0.24);
        }

        .student-icon-action {
            background: #fff;
            border: 1px solid #d8d3fb;
            box-shadow: 0 10px 24px rgba(142, 121, 240, 0.12);
            color: #6b5ca9 !important;
        }

        .student-icon-action:hover {
            background: #8E79F0;
            border-color: #8E79F0;
            color: #fff !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">
    <!-- Top Navigation -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="relative max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Left: Nav Icons -->
            <div class="flex items-center gap-8 text-gray-600">
                <a href="{{ route('student.dashboard') }}"
                    class="flex flex-col items-center gap-1 {{ request()->routeIs('student.dashboard') ? 'text-[#4A3B75]' : '' }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            stroke-linecap="round" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Policies</span>
                </a>
                <a href="{{ route('student.claims.index') }}"
                    class="flex flex-col items-center gap-1 {{ request()->routeIs('student.claims.*') ? 'text-[#4A3B75]' : '' }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z" stroke-linecap="round" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Claims</span>
                </a>
            </div>

            <!-- Logo Center -->
            <div class="absolute left-1/2 -translate-x-1/2">
                <h1 class="text-2xl font-bold text-[#4A3B75] uppercase">{{ config('app.name') }}</h1>
            </div>

            <!-- Right Side Icons -->
            <div class="flex items-center gap-6 text-gray-600">
            <a href="#" class="hover:text-[#4A3B75] transition-colors"><svg width="20" height="20"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                        stroke-linecap="round" />
                </svg></a>
            <a href="{{ route('student.profile') }}"
                class="hover:text-[#4A3B75] transition-colors {{ request()->routeIs('student.profile') ? 'text-[#4A3B75]' : '' }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        stroke-linecap="round" />
                </svg>
            </a>

            <!-- Modern User Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center gap-2 focus:outline-none group">
                    <div
                        class="w-8 h-8 rounded-full bg-[#8E79F0]/10 text-[#8E79F0] flex items-center justify-center font-bold text-xs group-hover:bg-[#8E79F0] group-hover:text-white transition-all">
                        {{ substr(Auth::guard('student')->user()->full_name, 0, 1) }}
                    </div>
                    <svg class="w-4 h-4 text-gray-300 transition-transform" :class="{ 'rotate-180': open }"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                    class="absolute right-0 mt-4 w-48 bg-white rounded-2xl shadow-2xl shadow-purple-100 border border-gray-50 py-2 z-[100]"
                    x-cloak>

                    <div class="px-4 py-2 border-b border-gray-50 mb-2">
                        <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Account</p>
                        <p class="text-xs font-bold text-[#4A3B75] truncate">
                            {{ Auth::guard('student')->user()->full_name }}</p>
                    </div>

                    <a href="{{ route('student.profile') }}"
                        class="flex items-center gap-3 px-4 py-2 text-xs font-bold text-gray-500 hover:text-[#8E79F0] hover:bg-purple-50 transition-colors">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile Settings
                    </a>

                    <form action="{{ url('student/logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-2 text-xs font-bold text-red-400 hover:bg-red-50 transition-colors">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4m7 14l5-5-5-5m5 5H9" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-6 py-8 max-w-6xl">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white py-6 border-t border-gray-50 mt-auto">
        <div class="container mx-auto px-6 max-w-6xl text-center">
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </footer>
</body>

</html>
