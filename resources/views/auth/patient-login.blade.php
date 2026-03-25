<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Portal Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-14 h-14 bg-blue-600 rounded-2xl mb-4 shadow-xl shadow-slate-200">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                    </path>
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">HEALTH PORTAL</h1>
            <p class="text-slate-500 mt-2 font-medium">Access your dashboard</p>
        </div>

        <div
            class="bg-white rounded-[2.5rem] p-10 shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">

            @if(session('success'))
            <div
                class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <p class="text-emerald-700 text-sm font-bold leading-tight">{{ session('success') }}</p>
            </div>
            @endif

            @if($errors->any())
            <div
                class="mb-6 p-4 bg-red-50 text-red-600 text-sm rounded-2xl border border-red-100 font-bold flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('portal.login.post') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label
                        class="block text-[11px] font-bold text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">Account
                        Email</label>
                    <input type="email" name="email" required placeholder="name@example.com"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none transition-all placeholder:text-slate-300 text-slate-900 font-medium">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2 ml-1">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.15em]">Secure
                            Password</label>
                        <a href="#"
                            class="text-[11px] font-bold text-blue-600 hover:text-blue-800 uppercase tracking-wider transition-colors">Forgot?</a>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none transition-all placeholder:text-slate-300">
                </div>

                <div class="flex items-center ml-1">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-4 h-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900">
                    <label for="remember" class="ml-2 text-sm text-slate-500 font-medium cursor-pointer">Remember
                        me</label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold shadow-xl shadow-slate-200 transition-all hover:shadow-2xl active:scale-[0.98] mt-2 flex items-center justify-center gap-2">
                    Sign In to Portal
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="mt-8 flex items-center justify-center gap-4">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                </svg>
                HIPAA Compliant
            </p>
            <div class="w-1 h-1 bg-slate-300 rounded-full"></div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                AES-256 Encrypted
            </p>
        </div>
    </div>

</body>

</html>
