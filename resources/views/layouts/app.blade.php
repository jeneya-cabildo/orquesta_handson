<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Review System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black min-h-screen">

    <nav class="bg-white border-b border-gray-300 shadow-sm p-4 mb-6">
        <h1 class="text-2xl font-bold text-center text-black">🎬 Movie Review System</h1>
    </nav>

    <div class="container mx-auto px-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-black px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>

</body>
</html>
