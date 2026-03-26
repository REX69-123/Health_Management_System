<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin | ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fafc] flex h-screen overflow-hidden text-slate-800">

    <main class="flex-1 overflow-y-auto p-8">
        <div class="max-w-2xl mx-auto">

            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-slate-800">Add New Administrator</h1>
                <a href="{{ route('admins.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800">← Back to Admins</a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <form action="{{ route('admins.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name</label>
                        <input type="text" name="name" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 text-sm" placeholder="e.g. Jane Doe">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="email" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 text-sm" placeholder="admin@clinic.com">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password</label>
                            <input type="password" name="password" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 text-sm" placeholder="••••••••">
                            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 text-sm" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('admins.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-600 text-sm font-bold rounded-lg hover:bg-slate-200 transition">Cancel</a>
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 transition shadow-sm">
                            Create Administrator
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</body>
</html>
