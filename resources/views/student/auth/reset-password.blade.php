<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 overflow-hidden h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden w-full max-w-6xl flex h-[600px]">
        <!-- Left Side: Illustration -->
        <div class="hidden md:flex flex-col justify-between p-12 w-1/2 bg-[#fdfcff] relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-4xl font-medium text-[#4A3B75] mb-2">Set a new</h1>
                <h2 class="text-5xl font-bold text-[#4A3B75]">password</h2>
                <p class="text-gray-500 mt-8 max-w-sm leading-relaxed">
                    Choose a strong password to keep your account secure. Make sure it's at least 6 characters long.
                </p>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-48 bg-gradient-to-t from-[#8E79F0] to-transparent opacity-20"></div>
            <div class="relative z-10 self-center">
                <img src="{{ asset('assets/images/auth-illustration.png') }}" alt="Illustration" class="max-h-64 object-contain opacity-90 mix-blend-multiply" onerror="this.src='https://placehold.co/400x300/f3f4f6/4A3B75?text=Illustration'">
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full md:w-1/2 flex flex-col items-center justify-center p-12">
            <div class="w-full max-w-sm">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-[#4A3B75] lowercase">{{ config('app.name') }}</h3>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-lg text-sm border border-red-100 text-center">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('student.password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $email) }}" required autofocus
                            class="w-full bg-[#f4f7ff] border-none rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#8E79F0] outline-none text-gray-700">
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">New Password</label>
                        <input type="password" name="password" required
                            class="w-full bg-[#f4f7ff] border-none rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#8E79F0] outline-none text-gray-700 tracking-widest">
                    </div>

                    <div class="mb-8">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full bg-[#f4f7ff] border-none rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#8E79F0] outline-none text-gray-700 tracking-widest">
                    </div>

                    <div class="flex flex-col items-center gap-6">
                        <button type="submit"
                            class="w-48 py-3 bg-gradient-to-r from-[#8E79F0] to-[#A294F9] text-white font-bold rounded-full shadow-lg shadow-purple-200 hover:scale-105 transition-transform uppercase tracking-widest text-sm">
                            Reset Password
                        </button>
                        <a href="{{ route('student.login') }}" class="text-xs text-gray-400 hover:text-gray-600">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
