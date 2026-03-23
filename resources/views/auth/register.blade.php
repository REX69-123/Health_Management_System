<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Sign Up - ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="px-8 py-6 border-b border-slate-200 text-center">
            <h2 class="text-2xl font-bold text-slate-800">Create an Account</h2>
            <p class="text-sm text-slate-500 mt-1">Register for staff access to the clinic system.</p>
        </div>

        <form action="{{ Auth::check() ? route('admin.staff.store') : route('register.store') }}" method="POST"
            class="p-8">
            @csrf

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-2">Full Name (Include Title)</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none"
                    placeholder="e.g. Dr. Jane Doe or Nurse Mark">
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none"
                    placeholder="staff@clinic.com">
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
            </div>

            <div class="mb-8">
                <label class="block text-sm font-medium text-slate-700 mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg shadow-sm">
                {{ Auth::check() ? 'Add Staff Member' : 'Create Admin Account' }}
            </button>
        </form>
    </div>

</body>

</html>
