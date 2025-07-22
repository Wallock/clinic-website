@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-sky-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">ทีมแพทย์ผู้เชี่ยวชาญ</h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                    แพทย์ที่มีประสบการณ์และความเชี่ยวชาญในสาขาต่างๆ พร้อมให้การดูแลที่ดีที่สุด
                </p>
            </div>
        </div>
    </section>

    <!-- Search & Filter Section -->
    <section class="py-8 bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <!-- Search -->
                <div class="relative flex-1 max-w-md">
                    <form method="GET" action="{{ route('doctors.search') }}">
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="ค้นหาแพทย์หรือความเชี่ยวชาญ..."
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <button type="submit" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <span class="sr-only">ค้นหา</span>
                                <i class="fas fa-arrow-right text-primary-600 hover:text-primary-700"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Filter by Specialization -->
                @if (isset($specializations) && $specializations->count() > 0)
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('doctors.index') }}"
                            class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ !request('specialization') ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            ทั้งหมด
                        </a>
                        @foreach ($specializations as $spec)
                            <a href="{{ route('doctors.index', ['specialization' => $spec]) }}"
                                class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ request('specialization') === $spec ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                {{ $spec }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Doctors Grid Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (request('q') || request('specialization'))
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">
                        ผลการค้นหา
                        @if (request('q'))
                            สำหรับ "<span class="text-primary-600">{{ request('q') }}</span>"
                        @endif
                        @if (request('specialization'))
                            ในสาขา "<span class="text-primary-600">{{ request('specialization') }}</span>"
                        @endif
                    </h2>
                    <p class="text-gray-600 mt-2">พบ {{ $doctors->total() }} ท่าน</p>
                </div>
            @endif

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($doctors as $doctor)
                    <div class="card doctor-card group bg-white">
                        <!-- Doctor Image -->
                        <div class="relative mb-6">
                            @if ($doctor->image_path)
                                <img src="{{ Storage::url($doctor->image_path) }}" alt="{{ $doctor->name }}"
                                    class="doctor-image group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div
                                    class="doctor-image bg-gradient-to-r from-primary-500 to-sky-400 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                    <i class="fas fa-user-md text-5xl text-white"></i>
                                </div>
                            @endif

                            <!-- Online Status Indicator -->
                            <div class="absolute bottom-2 right-2">
                                <div
                                    class="w-6 h-6 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                                    <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Doctor Info -->
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-primary-600 transition-colors">
                                {{ $doctor->name }}
                            </h3>
                            <p class="text-primary-600 font-semibold mb-3">{{ $doctor->specialization }}</p>

                            <!-- Experience & Languages -->
                            <div class="flex flex-wrap justify-center gap-2 mb-4">
                                @if ($doctor->experience)
                                    <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                                        <i class="fas fa-briefcase mr-1"></i>
                                        {{ Str::limit($doctor->experience, 20) }}
                                    </span>
                                @endif
                                @if ($doctor->languages && count($doctor->languages) > 0)
                                    <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">
                                        <i class="fas fa-language mr-1"></i>
                                        {{ implode(', ', array_slice($doctor->languages, 0, 2)) }}
                                    </span>
                                @endif
                            </div>

                            <!-- Description -->
                            <p class="text-gray-600 mb-6 leading-relaxed text-sm">
                                {{ Str::limit($doctor->description, 120) }}
                            </p>

                            <!-- Consultation Fee -->
                            @if ($doctor->consultation_fee)
                                <div class="bg-gradient-to-r from-primary-50 to-sky-50 rounded-lg p-3 mb-6">
                                    <span class="text-xs text-gray-600">ค่าตรวจ</span>
                                    <div class="text-lg font-bold text-primary-600">
                                        ฿{{ number_format($doctor->consultation_fee) }}
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('doctors.show', $doctor) }}" class="btn-primary w-full justify-center">
                                    <i class="fas fa-user mr-2"></i>
                                    ดูรายละเอียด
                                </a>
                                <a href="{{ route('contact') }}" class="btn-secondary w-full justify-center">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    นัดหมาย
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-user-md text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">
                            @if (request('q') || request('specialization'))
                                ไม่พบแพทย์ที่ตรงกับการค้นหา
                            @else
                                ยังไม่มีข้อมูลแพทย์
                            @endif
                        </h3>
                        <p class="text-gray-600 mb-8">
                            @if (request('q') || request('specialization'))
                                ลองค้นหาด้วยคำค้นอื่น หรือดูแพทย์ทั้งหมด
                            @else
                                ข้อมูลแพทย์กำลังจะอัพเดทเร็วๆ นี้
                            @endif
                        </p>
                        @if (request('q') || request('specialization'))
                            <a href="{{ route('doctors.index') }}" class="btn-primary">
                                <i class="fas fa-users mr-2"></i>
                                ดูแพทย์ทั้งหมด
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($doctors->hasPages())
                <div class="mt-16 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($doctors->onFirstPage())
                            <span class="px-4 py-2 text-gray-400 bg-white rounded-xl shadow-soft cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $doctors->previousPageUrl() }}"
                                class="px-4 py-2 text-gray-600 bg-white rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($doctors->getUrlRange(1, $doctors->lastPage()) as $page => $url)
                            @if ($page == $doctors->currentPage())
                                <span
                                    class="px-4 py-2 text-white bg-gradient-to-r from-primary-600 to-sky-500 rounded-xl shadow-soft">
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-4 py-2 text-gray-600 bg-white rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($doctors->hasMorePages())
                            <a href="{{ $doctors->nextPageUrl() }}"
                                class="px-4 py-2 text-gray-600 bg-white rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="px-4 py-2 text-gray-400 bg-white rounded-xl shadow-soft cursor-not-allowed">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </nav>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-600 to-sky-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                ไม่แน่ใจว่าจะเลือกแพทย์คนไหน?
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                ติดต่อเราเพื่อปรึกษาและขอคำแนะนำในการเลือกแพทย์ที่เหมาะสมกับอาการของคุณ
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                    class="btn-primary bg-white text-primary-600 hover:bg-gray-100 text-lg px-8 py-4">
                    <i class="fas fa-comments mr-2"></i>
                    ปรึกษาเรา
                </a>
                <a href="tel:02-xxx-xxxx"
                    class="btn-secondary bg-transparent border-white text-white hover:bg-white hover:text-primary-600 text-lg px-8 py-4">
                    <i class="fas fa-phone mr-2"></i>
                    โทรเลย
                </a>
            </div>
        </div>
    </section>
@endsection
