<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">
    <nav class="bg-white border-b border-slate-200 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <span class="text-xl font-bold text-blue-600">Health Portal</span>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
