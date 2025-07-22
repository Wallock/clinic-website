@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section
        class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-primary-600 via-primary-700 to-sky-600">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-0 -left-4 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-blob">
            </div>
            <div
                class="absolute top-0 -right-4 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-20 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-white animate-slide-in-left">
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                        สุขภาพดี
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-pink-300">
                            เริ่มต้นที่นี่
                        </span>
                    </h1>
                    <p class="text-xl md:text-2xl text-blue-100 mb-8 leading-relaxed">
                        ให้บริการด้านสุขภาพอย่างครอบคลุมด้วยทีมแพทย์ผู้เชี่ยวชาญ
                        เทคโนลยีที่ทันสมัย และการดูแลที่ใส่ใจในทุกรายละเอียด
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('contact') }}" class="btn-primary text-lg px-8 py-4">
                            <i class="fas fa-calendar-check mr-2"></i>
                            นัดหมายแพทย์
                        </a>
                        <a href="{{ route('about') }}"
                            class="btn-secondary text-lg px-8 py-4 bg-white/10 border-white/30 text-white hover:bg-white/20">
                            เกี่ยวกับเรา
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <div class="relative animate-slide-in-right">
                    <div class="relative z-10">
                        <div
                            class="w-96 h-96 mx-auto bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20">
                            <i class="fas fa-heartbeat text-9xl text-white/30"></i>
                        </div>
                    </div>

                    <!-- Floating Elements -->
                    <div
                        class="absolute top-10 left-10 w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm animate-bounce-slow">
                        <i class="fas fa-stethoscope text-2xl text-white"></i>
                    </div>
                    <div
                        class="absolute top-32 right-0 w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm animate-pulse-slow">
                        <i class="fas fa-pills text-xl text-white"></i>
                    </div>
                    <div
                        class="absolute bottom-20 left-0 w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm animate-bounce-slow">
                        <i class="fas fa-user-md text-2xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#services" class="text-white/70 hover:text-white transition-colors">
                <i class="fas fa-chevron-down text-2xl"></i>
            </a>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>ทีมแพทย์ผู้เชี่ยวชาญ</h2>
                <p>แพทย์ที่มีประสบการณ์และความเชี่ยวชาญในสาขาต่างๆ</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($doctors as $doctor)
                    <div class="card doctor-card group">
                        @if ($doctor->image_path)
                            <img src="{{ Storage::url($doctor->image_path) }}" alt="{{ $doctor->name }}"
                                class="doctor-image group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div
                                class="doctor-image bg-gradient-to-r from-primary-500 to-sky-400 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <i class="fas fa-user-md text-4xl text-white"></i>
                            </div>
                        @endif
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $doctor->name }}</h3>
                        <p class="text-primary-600 font-semibold mb-4">{{ $doctor->specialization }}</p>
                        <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($doctor->description, 100) }}</p>
                        <a href="{{ route('doctors.show', $doctor) }}" class="btn-secondary">
                            ดูรายละเอียด
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-md text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">เร็วๆ นี้</h3>
                        <p class="text-gray-600">ข้อมูลแพทย์กำลังจะมาเร็วๆ นี้</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('doctors.index') }}" class="btn-primary text-lg px-8 py-4">
                    ดูทีมแพทย์ทั้งหมด
                    <i class="fas fa-users ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>บทความสุขภาพ</h2>
                <p>ความรู้และข้อมูลสุขภาพที่น่าสนใจ</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <div class="card group overflow-hidden">
                        @if ($article->featured_image)
                            <div class="relative overflow-hidden">
                                <img src="{{ Storage::url($article->featured_image) }}"
                                    class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500"
                                    alt="{{ $article->title }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                @if ($article->category)
                                    <span class="badge badge-primary">{{ $article->category }}</span>
                                @endif
                                <span class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ $article->published_at->format('d M Y') }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-primary-600 transition-colors">
                                {{ $article->title }}
                            </h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                            </p>

                            @if ($article->tags)
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @foreach (array_slice($article->tags, 0, 3) as $tag)
                                        <span
                                            class="text-xs px-2 py-1 bg-gray-100 text-gray-600 rounded-full">#{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <a href="{{ route('articles.show', $article) }}"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium group-hover:translate-x-1 transition-transform duration-300">
                                อ่านต่อ
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-newspaper text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">เร็วๆ นี้</h3>
                        <p class="text-gray-600">บทความสุขภาพกำลังจะมาเร็วๆ นี้</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('articles.index') }}" class="btn-primary text-lg px-8 py-4">
                    ดูบทความทั้งหมด
                    <i class="fas fa-newspaper ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-600 to-sky-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                พร้อมดูแลสุขภาพของคุณแล้ว
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                ปรึกษาแพทย์ผู้เชี่ยวชาญได้ทันที หรือนัดหมายล่วงหน้าเพื่อความสะดวกของคุณ
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                    class="btn-primary bg-white text-primary-600 hover:bg-gray-100 text-lg px-8 py-4">
                    <i class="fas fa-calendar-check mr-2"></i>
                    นัดหมายเลย
                </a>
                <a href="tel:02-xxx-xxxx"
                    class="btn-secondary bg-transparent border-white text-white hover:bg-white hover:text-primary-600 text-lg px-8 py-4">
                    <i class="fas fa-phone mr-2"></i>
                    โทรปรึกษา
                </a>
            </div>
        </div>
    </section>

    <style>
        @keyframes blob {

            0%,
            100% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
@endsection
