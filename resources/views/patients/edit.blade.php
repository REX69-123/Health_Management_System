<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient - ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 min-h-screen p-8 flex items-center justify-center">

    <div class="w-full max-w-2xl bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Edit Patient Profile</h2>
                <p class="text-sm text-slate-500">Update information for {{ $patient->first_name }} {{
                    $patient->last_name }}.</p>
            </div>
            <a href="{{ route('patients.index') }}"
                class="text-sm font-medium text-slate-400 hover:text-slate-600">Cancel</a>
        </div>

        <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-lg text-sm border border-red-200">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $patient->first_name) }}" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $patient->last_name) }}" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $patient->email) }}" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Account Status</label>
                    <select name="status" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <option value="Active" {{ (old('status', $patient->status) == 'Active') ? 'selected' : ''
                            }}>Active</option>
                        <option value="Inactive" {{ (old('status', $patient->status) == 'Inactive') ? 'selected' : ''
                            }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob', $patient->dob) }}" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Gender</label>
                    <select name="gender" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="Male" {{ (old('gender', $patient->gender) == 'Male') ? 'selected' : '' }}>Male
                        </option>
                        <option value="Female" {{ (old('gender', $patient->gender) == 'Female') ? 'selected' : ''
                            }}>Female</option>
                        <option value="Other" {{ (old('gender', $patient->gender) == 'Other') ? 'selected' : '' }}>Other
                        </option>
                    </select>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-200">
                <h3 class="text-md font-bold text-slate-800 mb-2">Portal Access</h3>
                <p class="text-xs text-slate-500 mb-4">If the patient forgot their password, you can generate a new one
                    here. Leave blank to keep their current password.</p>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">New Password (Optional)</label>
                    <input type="text" name="password" placeholder="Leave blank to keep unchanged"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none font-mono">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition-colors shadow-md">
                Save Changes
            </button>
        </form>
    </div>
</body>

</html>
