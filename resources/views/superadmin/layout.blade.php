<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col p-4">
            <h1 class="text-2xl font-bold mb-6">SuperAdmin</h1>
            <nav class="flex-1">
                <ul>
                    <li class="mb-4"><a href="#" class="block p-2 rounded hover:bg-gray-700">Dashboard</a></li>
                    <li class="mb-4"><a href="#" class="block p-2 rounded hover:bg-gray-700">Users</a></li>
                    <li class="mb-4"><a href="#" class="block p-2 rounded hover:bg-gray-700">Settings</a></li>
                </ul>
            </nav>
            <a href="#" class="block p-2 rounded bg-red-600 text-center hover:bg-red-700">Logout</a>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dashboard</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Admin</span>
                    <img src="https://via.placeholder.com/40" class="rounded-full" alt="User Avatar">
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-6">
                @section('content')
                    
                @show
            </main>
        </div>
    </div>
</body>

</html>