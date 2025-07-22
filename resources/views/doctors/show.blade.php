@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-r from-primary-600 to-sky-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Doctor Image -->
                <div class="text-center lg:text-left">
                    @if ($doctor->image_path)
                        <img src="{{ Storage::url($doctor->image_path) }}" alt="{{ $doctor->name }}"
                            class="w-64 h-64 lg:w-80 lg:h-80 rounded-full object-cover mx-auto lg:mx-0 border-8 border-white/20 shadow-2xl">
                    @else
                        <div
                            class="w-64 h-64 lg:w-80 lg:h-80 bg-white/20 rounded-full flex items-center justify-center mx-auto lg:mx-0 border-8 border-white/20">
                            <i class="fas fa-user-md text-8xl text-white/60"></i>
                        </div>
                    @endif
                </div>

                <!-- Doctor Info -->
                <div class="text-center lg:text-left">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full text-blue-100 text-sm font-medium mb-4">
                        <i class="fas fa-stethoscope mr-2"></i>
                        {{ $doctor->specialization }}
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">{{ $doctor->name }}</h1>
                    <p class="text-xl md:text-2xl text-blue-100 mb-8 leading-relaxed">
                        {{ $doctor->description }}
                    </p>

                    <!-- Quick Info -->
                    <div class="flex flex-wrap justify-center lg:justify-start gap-4 mb-8">
                        @if ($doctor->experience)
                            <div class="flex items-center space-x-2 bg-white/10 rounded-lg px-4 py-2">
                                <i class="fas fa-briefcase text-blue-200"></i>
                                <span class="text-blue-100">{{ $doctor->experience }}</span>
                            </div>
                        @endif
                        @if ($doctor->languages && count($doctor->languages) > 0)
                            <div class="flex items-center space-x-2 bg-white/10 rounded-lg px-4 py-2">
                                <i class="fas fa-language text-blue-200"></i>
                                <span class="text-blue-100">{{ implode(', ', $doctor->languages) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('contact') }}"
                            class="btn-primary bg-white text-primary-600 hover:bg-gray-100 text-lg px-8 py-4">
                            <i class="fas fa-calendar-check mr-2"></i>
                            นัดหมายแพทย์
                        </a>
                        <a href="tel:{{ $doctor->phone ?? '02-xxx-xxxx' }}"
                            class="btn-secondary bg-transparent border-white text-white hover:bg-white hover:text-primary-600 text-lg px-8 py-4">
                            <i class="fas fa-phone mr-2"></i>
                            โทรสอบถาม
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctor Details Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-12">
                    <!-- About Doctor -->
                    <div class="card-flat p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-user-md text-primary-600 mr-3"></i>
                            เกี่ยวกับแพทย์
                        </h2>
                        <div class="prose prose-lg max-w-none text-gray-600">
                            <p class="leading-relaxed">{{ $doctor->description }}</p>
                        </div>
                    </div>

                    <!-- Education -->
                    @if ($doctor->education)
                        <div class="card-flat p-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-graduation-cap text-primary-600 mr-3"></i>
                                ประวัติการศึกษา
                            </h2>
                            <div class="space-y-4">
                                @foreach (explode("\n", $doctor->education) as $edu)
                                    @if (trim($edu))
                                        <div class="flex items-start space-x-4">
                                            <div class="w-3 h-3 bg-primary-600 rounded-full mt-2 flex-shrink-0"></div>
                                            <p class="text-gray-600 text-lg">{{ trim($edu) }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Experience -->
                    @if ($doctor->experience)
                        <div class="card-flat p-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-briefcase text-primary-600 mr-3"></i>
                                ประสบการณ์ทำงาน
                            </h2>
                            <div class="space-y-4">
                                @foreach (explode("\n", $doctor->experience) as $exp)
                                    @if (trim($exp))
                                        <div class="flex items-start space-x-4">
                                            <div class="w-3 h-3 bg-sky-500 rounded-full mt-2 flex-shrink-0"></div>
                                            <p class="text-gray-600 text-lg">{{ trim($exp) }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Contact Card -->
                    <div class="card-flat p-6 sticky top-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">ข้อมูลติดต่อ</h3>

                        <div class="space-y-4">
                            @if ($doctor->consultation_fee)
                                <div class="bg-gradient-to-r from-primary-50 to-sky-50 rounded-lg p-4">
                                    <div class="text-sm text-gray-600 mb-1">ค่าตรวจ</div>
                                    <div class="text-2xl font-bold text-primary-600">
                                        ฿{{ number_format($doctor->consultation_fee) }}
                                    </div>
                                </div>
                            @endif

                            @if ($doctor->phone)
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-phone text-green-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-600">โทรศัพท์</div>
                                        <a href="tel:{{ $doctor->phone }}"
                                            class="font-medium text-gray-900 hover:text-primary-600">
                                            {{ $doctor->phone }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($doctor->email)
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-envelope text-blue-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-600">อีเมล</div>
                                        <a href="mailto:{{ $doctor->email }}"
                                            class="font-medium text-gray-900 hover:text-primary-600">
                                            {{ $doctor->email }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($doctor->available_days && count($doctor->available_days) > 0)
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-calendar text-purple-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-600">วันที่ให้บริการ</div>
                                        <div class="font-medium text-gray-900">
                                            {{ implode(', ', $doctor->available_days) }}
                                        </div>
                                        @if ($doctor->available_hours)
                                            <div class="text-sm text-gray-600 mt-1">
                                                เวลา: {{ $doctor->available_hours }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if ($doctor->languages && count($doctor->languages) > 0)
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-language text-orange-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-600">ภาษาที่สื่อสารได้</div>
                                        <div class="font-medium text-gray-900">
                                            {{ implode(', ', $doctor->languages) }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3 mt-8">
                            <a href="{{ route('contact') }}" class="w-full btn-primary justify-center">
                                <i class="fas fa-calendar-check mr-2"></i>
                                นัดหมายแพทย์
                            </a>
                            <a href="tel:{{ $doctor->phone ?? '02-xxx-xxxx' }}"
                                class="w-full btn-secondary justify-center">
                                <i class="fas fa-phone mr-2"></i>
                                โทรสอบถาม
                            </a>
                        </div>
                    </div>

                    <!-- Specialization Info -->
                    <div class="card-flat p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">ความเชี่ยวชาญ</h3>
                        <div class="bg-gradient-to-r from-primary-500 to-sky-400 rounded-lg p-4 text-white text-center">
                            <i class="fas fa-stethoscope text-3xl mb-3"></i>
                            <h4 class="text-lg font-bold">{{ $doctor->specialization }}</h4>
                        </div>
                    </div>

                    <!-- Share -->
                    <div class="card-flat p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">แชร์แพทย์ท่านนี้</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="#"
                                class="flex items-center justify-center space-x-2 p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors group">
                                <i class="fab fa-facebook-f text-blue-600 group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-medium text-blue-600">Facebook</span>
                            </a>
                            <a href="#"
                                class="flex items-center justify-center space-x-2 p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors group">
                                <i class="fab fa-line text-green-500 group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-medium text-green-500">LINE</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Doctors -->
    @if (isset($relatedDoctors) && $relatedDoctors->count() > 0)
        <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="section-title">
                    <h2>แพทย์ท่านอื่นในสาขา{{ $doctor->specialization }}</h2>
                    <p>แพทย์ผู้เชี่ยวชาญในสาขาเดียวกัน</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach ($relatedDoctors as $relatedDoctor)
                        <div class="card doctor-card group bg-white">
                            @if ($relatedDoctor->image_path)
                                <img src="{{ Storage::url($relatedDoctor->image_path) }}"
                                    alt="{{ $relatedDoctor->name }}"
                                    class="doctor-image group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div
                                    class="doctor-image bg-gradient-to-r from-primary-500 to-sky-400 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                    <i class="fas fa-user-md text-4xl text-white"></i>
                                </div>
                            @endif
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $relatedDoctor->name }}</h3>
                            <p class="text-primary-600 font-semibold mb-4">{{ $relatedDoctor->specialization }}</p>
                            <p class="text-gray-600 mb-6 leading-relaxed text-sm">
                                {{ Str::limit($relatedDoctor->description, 100) }}
                            </p>
                            <a href="{{ route('doctors.show', $relatedDoctor) }}"
                                class="btn-secondary w-full justify-center">
                                ดูรายละเอียด
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-600 to-sky-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                พร้อมดูแลสุขภาพของคุณแล้ว
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                นัดหมายกับ {{ $doctor->name }} วันนี้ เพื่อรับการดูแลที่ดีที่สุด
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                    class="btn-primary bg-white text-primary-600 hover:bg-gray-100 text-lg px-8 py-4">
                    <i class="fas fa-calendar-check mr-2"></i>
                    นัดหมายเลย
                </a>
                <a href="{{ route('doctors.index') }}"
                    class="btn-secondary bg-transparent border-white text-white hover:bg-white hover:text-primary-600 text-lg px-8 py-4">
                    <i class="fas fa-users mr-2"></i>
                    ดูแพทย์ท่านอื่น
                </a>
            </div>
        </div>
    </section>
@endsection
