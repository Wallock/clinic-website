<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-thai antialiased bg-gray-50">
    <!-- Navigation -->
    <nav
        class="fixed top-0 w-full bg-gradient-to-r from-primary-600 via-primary-700 to-sky-600 z-50 shadow-large backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}"
                        class="flex items-center space-x-3 text-white hover:text-primary-200 transition-colors duration-300">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-heart-pulse text-xl"></i>
                        </div>
                        <span class="text-xl md:text-2xl font-bold">{{ config('app.name', 'คลีนิก') }}</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}"
                        class="navbar-link {{ Request::routeIs('home') ? 'active' : '' }}">หน้าแรก</a>
                    <a href="{{ route('about') }}"
                        class="navbar-link {{ Request::routeIs('about') ? 'active' : '' }}">เกี่ยวกับเรา</a>
                    <a href="{{ route('doctors.index') }}"
                        class="navbar-link {{ Request::routeIs('doctors.*') ? 'active' : '' }}">ทีมแพทย์</a>
                    <a href="{{ route('articles.index') }}"
                        class="navbar-link {{ Request::routeIs('articles.*') ? 'active' : '' }}">บทความ</a>
                    <a href="{{ route('contact') }}"
                        class="navbar-link {{ Request::routeIs('contact') ? 'active' : '' }}">ติดต่อ</a>

                    @auth
                        <div class="relative group">
                            <button class="navbar-link flex items-center space-x-2">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-sm transition-transform group-hover:rotate-180"></i>
                            </button>
                            <div class="dropdown-menu">
                                <div class="py-2">
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-primary-50 transition-colors">
                                        <i class="fas fa-tachometer-alt w-4 mr-2"></i>แดชบอร์ด
                                    </a>
                                    <hr class="my-1">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50 transition-colors">
                                            <i class="fas fa-sign-out-alt w-4 mr-2"></i>ออกจากระบบ
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary ml-4">เข้าสู่ระบบ</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-white hover:text-primary-200 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="md:hidden hidden py-4 border-t border-white/20">
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('home') }}"
                        class="navbar-link {{ Request::routeIs('home') ? 'active' : '' }}">หน้าแรก</a>
                    <a href="{{ route('about') }}"
                        class="navbar-link {{ Request::routeIs('about') ? 'active' : '' }}">เกี่ยวกับเรา</a>
                    <a href="{{ route('doctors.index') }}"
                        class="navbar-link {{ Request::routeIs('doctors.*') ? 'active' : '' }}">ทีมแพทย์</a>
                    <a href="{{ route('articles.index') }}"
                        class="navbar-link {{ Request::routeIs('articles.*') ? 'active' : '' }}">บทความ</a>
                    <a href="{{ route('contact') }}"
                        class="navbar-link {{ Request::routeIs('contact') ? 'active' : '' }}">ติดต่อ</a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="navbar-link">แดชบอร์ด</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="navbar-link text-left w-full">ออกจากระบบ</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="navbar-link">เข้าสู่ระบบ</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16 md:pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-primary-500 to-sky-400 rounded-xl flex items-center justify-center">
                            <i class="fas fa-heart-pulse text-xl text-white"></i>
                        </div>
                        <span class="text-2xl font-bold">{{ config('app.name', 'คลีนิก') }}</span>
                    </div>
                    <p class="text-gray-400 text-lg leading-relaxed max-w-md">
                        ให้บริการด้านสุขภาพอย่างครอบคลุมด้วยทีมแพทย์ผู้เชี่ยวชาญ
                        เทคโนลยีที่ทันสมัย และการดูแลที่ใส่ใจในทุกรายละเอียด
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-primary-300">เมนูหลัก</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}"
                                class="text-gray-400 hover:text-white transition-colors">หน้าแรก</a></li>
                        <li><a href="{{ route('about') }}"
                                class="text-gray-400 hover:text-white transition-colors">เกี่ยวกับเรา</a></li>
                        <li><a href="{{ route('doctors.index') }}"
                                class="text-gray-400 hover:text-white transition-colors">ทีมแพทย์</a></li>
                        <li><a href="{{ route('articles.index') }}"
                                class="text-gray-400 hover:text-white transition-colors">บทความ</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-primary-300">ติดต่อเรา</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-primary-400"></i>
                            <span class="text-gray-400">02-xxx-xxxx</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-primary-400"></i>
                            <span class="text-gray-400">info@clinic.com</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-primary-400"></i>
                            <span class="text-gray-400">กรุงเทพมหานคร</span>
                        </li>
                    </ul>

                    <!-- Social Links -->
                    <div class="mt-6">
                        <h4 class="text-sm font-semibold mb-3 text-primary-300">ติดตามเรา</h4>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-primary-600 transition-all duration-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-green-600 transition-all duration-300">
                                <i class="fab fa-line"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-pink-600 transition-all duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-8 border-gray-800">

            <div class="text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'คลีนิก') }}. สงวนลิขสิทธิ์.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
