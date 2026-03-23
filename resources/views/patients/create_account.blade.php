<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Portal Account - ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 min-h-screen p-8 flex items-center justify-center">

    <div class="w-full max-w-lg bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-200 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Setup Portal Login</h2>
                <p class="text-sm text-slate-500">Create login credentials for {{ $patient->first_name }} {{ $patient->last_name }}.</p>
            </div>
            <a href="{{ route('patients.edit', $patient->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                &larr; Back to Step 1
            </a>
        </div>

        <form action="{{ route('patients.account.store', $patient->id) }}" method="POST" class="p-8 space-y-6">
            @csrf

            @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-lg text-sm border border-red-200">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Login Email</label>
                <input type="email" name="email" value="{{ $patient->email }}" readonly
                    class="w-full px-4 py-2 border rounded-lg bg-slate-100 text-slate-500 outline-none cursor-not-allowed">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Temporary Password</label>
                <input type="text" name="password" value="{{ old('password', \Illuminate\Support\Str::random(8)) }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none font-mono">
                <p class="text-xs text-slate-500 mt-2">Give this password to the patient so they can access the portal.</p>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg font-bold hover:bg-blue-700 transition-colors">
                Complete Registration
            </button>
        </form>
    </div>

</body>

</html>
