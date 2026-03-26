<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin | ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fafc] flex h-screen overflow-hidden text-slate-800">

    <main class="flex-1 overflow-y-auto p-8">
        <div class="max-w-2xl mx-auto">

            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-slate-800">Edit Administrator</h1>
                <a href="{{ route('admins.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800">← Back to Admins</a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <form action="{{ route('admins.update', $admin) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $admin->name) }}" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 text-sm">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 text-sm">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6 mt-2 border-t border-slate-100">
                        <div class="mb-4">
                            <h3 class="text-sm font-bold text-slate-800">Reset Password <span class="text-slate-400 font-normal ml-2">(Optional)</span></h3>
                            <p class="text-xs text-slate-500 mt-1">Leave these fields blank if you do not wish to change this administrator's password.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">New Password</label>
                                <input type="password" name="password" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 text-sm placeholder-slate-300" placeholder="Leave blank to keep current">
                                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 text-sm placeholder-slate-300" placeholder="Leave blank to keep current">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('admins.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-600 text-sm font-bold rounded-lg hover:bg-slate-200 transition">Cancel</a>
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 transition shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</body>
</html>
