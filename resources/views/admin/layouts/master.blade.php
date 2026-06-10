<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title') | {{ get_setting('app_name', config('app.name')) }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon"
        href="{{ get_setting('app_favicon') ? asset('storage/' . get_setting('app_favicon')) : asset('favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/perfect-scrollbar.min.css') }}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/style.css') }}" />
    <link defer rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/animate.css') }}" />
    @stack('styles')
    <style>
        [x-cloak] { display: none !important; }
        .font-inter { font-family: 'Inter', sans-serif; }

        /* === Primary color: #4A3B75 === */
        .text-primary, .hover\:text-primary:hover,
        .group:hover .group-hover\:text-primary,
        :is(.dark) .dark\:text-primary,
        :is(.dark) .dark\:hover\:text-primary:hover {
            color: #4A3B75 !important;
        }
        .bg-primary, .hover\:bg-primary:hover,
        :is(.dark) .dark\:bg-primary,
        :is(.dark) .dark\:hover\:bg-primary:hover,
        .peer:checked ~ .peer-checked\:bg-primary,
        .before\:bg-primary::before {
            background-color: #4A3B75 !important;
        }
        .border-primary, .hover\:border-primary:hover,
        :is(.dark) .dark\:border-primary {
            border-color: #4A3B75 !important;
        }
        .ring-primary { --tw-ring-color: #4A3B75 !important; }
        .text-primary\/10 { color: rgba(74, 59, 117, 0.1) !important; }

        /* === Sidebar: light bg #F0EAFA === */
        .sidebar > ul > li > a,
        .sidebar > ul > li > button,
        .sidebar > ul > li > a span,
        .sidebar > ul > li > button span {
            color: #4A3B75 !important;
        }
        .sidebar .sub-menu a,
        .sidebar .sub-menu a span {
            color: #6b5ca9 !important;
        }
        .sidebar > ul > li > a:hover,
        .sidebar > ul > li > button:hover {
            background-color: rgba(74, 59, 117, 0.08) !important;
            border-radius: 0.375rem !important;
        }
        .sidebar > ul > li > a:hover span,
        .sidebar > ul > li > button:hover span {
            color: #4A3B75 !important;
        }
        .sidebar .sub-menu a:hover {
            background-color: rgba(74, 59, 117, 0.08) !important;
            border-radius: 0.375rem !important;
        }
        .sidebar .sub-menu a:hover,
        .sidebar .sub-menu a:hover span {
            color: #4A3B75 !important;
        }
        .sidebar > ul > li > a:hover svg,
        .sidebar > ul > li > button:hover svg {
            color: #4A3B75 !important;
        }
        .sidebar > ul > li > a.active,
        .sidebar > ul > li > button.active {
            background-color: rgba(74, 59, 117, 0.12) !important;
            border-radius: 0.375rem !important;
        }
        .sidebar > ul > li > a.active span,
        .sidebar > ul > li > button.active span {
            color: #4A3B75 !important;
        }
        .sidebar h2 {
            color: #4A3B75 !important;
            background-color: rgba(184, 176, 196, 0.9) !important;
        }
        .sidebar .sub-menu svg {
            color: #6b5ca9;
        }
        .sidebar .sidebar-section-heading {
            color: #6b5ca9 !important;
            font-size: 0.65rem !important;
            letter-spacing: 0.1em !important;
        }

        /* === Scrollbar === */
        .sidebar .perfect-scrollbar::-webkit-scrollbar-thumb {
            background: #334155 !important;
        }

        /* === Header accent === */
        header .shadow-sm {
            box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }

        /* === Sidebar Width reduction from 260px to 220px overrides === */
        .sidebar {
            width: 220px !important;
        }
        @media (min-width: 1024px) {
            .main-container .main-content:where([dir=ltr],[dir=ltr] *) {
                margin-left: 220px !important;
            }
            .main-container .main-content:where([dir=rtl],[dir=rtl] *) {
                margin-right: 220px !important;
            }
            .vertical.toggle-sidebar .sidebar:where([dir=ltr],[dir=ltr] *) {
                left: -220px !important;
            }
            .vertical.toggle-sidebar .sidebar:where([dir=rtl],[dir=rtl] *) {
                right: -220px !important;
            }
            .vertical.toggle-sidebar .main-container .main-content:where([dir=ltr],[dir=ltr] *) {
                margin-left: 0 !important;
            }
            .vertical.toggle-sidebar .main-container .main-content:where([dir=rtl],[dir=rtl] *) {
                margin-right: 0 !important;
            }
        }
        
        /* Mobile / Tablet sidebar hidden state */
        @media (max-width: 1023px) {
            .sidebar:where([dir=ltr],[dir=ltr] *) {
                left: -220px !important;
            }
            .sidebar:where([dir=rtl],[dir=rtl] *) {
                right: -220px !important;
            }
            .toggle-sidebar .sidebar:where([dir=ltr],[dir=ltr] *) {
                left: 0 !important;
            }
            .toggle-sidebar .sidebar:where([dir=rtl],[dir=rtl] *) {
                right: 0 !important;
            }
        }

        /* Collapsible vertical sidebar hover / active states on desktop */
        .collapsible-vertical .sidebar:hover {
            width: 220px !important;
        }
        .collapsible-vertical.toggle-sidebar .sidebar {
            width: 220px !important;
        }
        @media (min-width: 1024px) {
            .collapsible-vertical.toggle-sidebar .main-content {
                width: calc(100% - 220px) !important;
            }
            .collapsible-vertical.toggle-sidebar .main-content:where([dir=ltr],[dir=ltr] *) {
                margin-left: 220px !important;
            }
            .collapsible-vertical.toggle-sidebar .main-content:where([dir=rtl],[dir=rtl] *) {
                margin-right: 220px !important;
            }
        }

    </style>
</head>

<body x-data="main" class="relative overflow-x-hidden font-inter text-sm font-normal antialiased"
    :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]">

    @include('admin.layouts.partials.loader')
    @include('admin.layouts.partials.scroll-to-top')

    <div class="main-container min-h-screen text-black dark:text-white-dark" :class="[$store.app.navbar]">
        @include('admin.layouts.partials.customizer')
        @include('admin.layouts.sidebar')

        <div class="main-content flex min-h-screen flex-col">
            @include('admin.layouts.header')

            <div class="animate__animated p-6" :class="[$store.app.animation]">
                @include('admin.layouts.flash-messages')
                @yield('content')
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    @include('admin.layouts.scripts')
    @stack('scripts')
</body>

</html>
