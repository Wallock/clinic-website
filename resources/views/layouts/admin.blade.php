<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Vite Assets -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-thai antialiased bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside
            class="w-64 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 shadow-2xl fixed inset-y-0 left-0 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 z-30"
            id="sidebar">
            <!-- Logo -->
            <div class="flex items-center justify-center h-20 bg-gradient-to-r from-primary-600 to-sky-500">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-white">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-heart-pulse text-lg"></i>
                    </div>
                    <span class="text-xl font-bold">Admin Panel</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="mt-8 px-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="admin-nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                            <span>แดชบอร์ด</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles.index') }}"
                            class="admin-nav-link {{ Request::routeIs('admin.articles.*') ? 'active' : '' }}">
                            <i class="fas fa-newspaper w-5 mr-3"></i>
                            <span>จัดการบทความ</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-nav-link">
                            <i class="fas fa-user-md w-5 mr-3"></i>
                            <span>จัดการแพทย์</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-nav-link">
                            <i class="fas fa-stethoscope w-5 mr-3"></i>
                            <span>จัดการบริการ</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-nav-link">
                            <i class="fas fa-cog w-5 mr-3"></i>
                            <span>การตั้งค่า</span>
                        </a>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-8 border-gray-700">

                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" target="_blank" class="admin-nav-link">
                            <i class="fas fa-external-link-alt w-5 mr-3"></i>
                            <span>ดูเว็บไซต์</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="admin-nav-link w-full text-left">
                                <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                                <span>ออกจากระบบ</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            <!-- Top Bar -->
            <header
                class="bg-white shadow-soft border-b border-gray-200 h-20 flex items-center justify-between px-6 lg:px-8">
                <!-- Mobile menu button -->
                <button id="sidebar-toggle" class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Page Title (optional) -->
                <div class="hidden lg:block">
                    <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'แดชบอร์ด')</h1>
                </div>

                <!-- User Info -->
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">ผู้ดูแลระบบ</p>
                    </div>
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-primary-500 to-sky-400 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100 p-6 lg:p-8">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-soft animate-fade-in-down"
                        role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-lg"></i>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-soft animate-fade-in-down"
                        role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-soft animate-fade-in-down"
                        role="alert">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle mr-3 text-lg mt-0.5"></i>
                            <div>
                                <span class="font-medium">กรุณาแก้ไขข้อผิดพลาดต่อไปนี้:</span>
                                <ul class="mt-2 list-disc list-inside space-y-1 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay"
        class="fixed inset-0 z-20 bg-gray-600 bg-opacity-75 transition-opacity duration-300 ease-linear opacity-0 pointer-events-none lg:hidden">
    </div>

    <script>
        // Sidebar toggle for mobile
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('opacity-0');
            overlay.classList.toggle('pointer-events-none');
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', toggleSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }

        // Auto-hide flash messages
        setTimeout(() => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 500);
            });
        }, 8000);
    </script>

    @stack('scripts')
</body>

</html>
