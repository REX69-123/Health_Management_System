<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Portal Account - ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen p-8 flex items-center justify-center">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-100 bg-white flex justify-between items-center">
            <div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Setup Portal Login</h2>
                <p class="text-sm font-medium text-slate-500 mt-0.5">Credentials for {{ $patient->first_name }} {{ $patient->last_name }}</p>
            </div>
            <a href="{{ route('patients.index') }}" class="text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-blue-600 transition-colors">
                Cancel
            </a>
        </div>

        <form action="{{ route('patients.account.store', $patient->id) }}" method="POST" class="p-8 space-y-6">
            @csrf

            @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm border border-red-100 font-medium">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Login Email</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ $patient->email }}" readonly
                        class="w-full px-4 py-3 border border-slate-100 rounded-xl bg-slate-50 text-slate-500 font-medium outline-none cursor-not-allowed">
                    <div class="absolute inset-y-0 right-3 flex items-center">
                        <svg class="w-4 h-4 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"/></svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Temporary Password</label>
                <input type="text" name="password"
                    value="{{ old('password', \Illuminate\Support\Str::random(8)) }}"
                    required
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none font-mono text-lg font-bold text-blue-600 tracking-wider transition-all">

                <div class="mt-4 bg-blue-50 rounded-xl p-4 flex gap-3 items-start border border-blue-100">
                    <svg class="w-5 h-5 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-xs text-blue-700 leading-relaxed font-medium">
                        <strong>Security Note:</strong> Please provide this temporary password to the patient. They can use it to log in to their personal health portal immediately.
                    </p>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-blue-600 transition-all shadow-lg shadow-slate-200 flex items-center justify-center gap-2 group">
                Complete Registration
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>
    </div>
</body>
</html>
