@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-sky-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">เกี่ยวกับเรา</h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                    พวกเรามุ่งมั่นในการให้บริการด้านสุขภาพที่ดีที่สุด
                    ด้วยใจที่ใส่ใจในทุกรายละเอียด
                </p>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        ภารกิจของเรา
                    </h2>
                    <p class="text-lg text-gray-600 leading-relaxed mb-6">
                        เราเชื่อว่าทุกคนมีสิทธิ์ที่จะได้รับการดูแลสุขภาพที่ดีที่สุด
                        ด้วยเหตุนี้เราจึงมุ่งมั่นที่จะนำเสนอบริการด้านสุขภาพที่ครอบคลุม
                        โดยทีมแพทย์ผู้เชี่ยวชาญและเทคโนโลยีที่ทันสมัย
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed mb-8">
                        เป้าหมายของเราคือการเป็นคลีนิกที่คุณและครอบครัวไว้วางใจ
                        สำหรับการดูแลสุขภาพในทุกช่วงวัย ด้วยการบริการที่อบอุ่น
                        และการรักษาที่มีประสิทธิภาพ
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600 mb-2">15+</div>
                            <div class="text-gray-600">ปีประสบการณ์</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600 mb-2">1000+</div>
                            <div class="text-gray-600">ผู้ป่วยที่วางใจ</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-gradient-to-r from-primary-500 to-sky-400 rounded-2xl p-8 text-white">
                        <div class="text-center">
                            <i class="fas fa-heart text-6xl mb-6 opacity-80"></i>
                            <h3 class="text-2xl font-bold mb-4">ค่านิยมของเรา</h3>
                            <ul class="space-y-3 text-left">
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle mr-3"></i>
                                    ใส่ใจในทุกรายละเอียด
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle mr-3"></i>
                                    มาตรฐานการรักษาสูง
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle mr-3"></i>
                                    บริการด้วยความเอาใจใส่
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle mr-3"></i>
                                    เทคโนโลยีที่ทันสมัย
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>บริการหลักของเรา</h2>
                <p>เรานำเสนอบริการด้านสุขภาพที่ครอบคลุมและทันสมัย</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-soft hover:shadow-large transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-stethoscope text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">ตรวจสุขภาพทั่วไป</h3>
                    <p class="text-gray-600 leading-relaxed">
                        การตรวจสุขภาพประจำปีที่ครอบคลุม เพื่อป้องกันและตรวจหาโรคในระยะเริ่มต้น
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-soft hover:shadow-large transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-user-md text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">แพทย์เชี่ยวชาญ</h3>
                    <p class="text-gray-600 leading-relaxed">
                        ทีมแพทย์ที่มีประสบการณ์และความเชี่ยวชาญในสาขาต่างๆ พร้อมให้คำปรึกษา
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-soft hover:shadow-large transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-microscope text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">เทคโนโลยีทันสมัย</h3>
                    <p class="text-gray-600 leading-relaxed">
                        อุปกรณ์การแพทย์และเทคโนโลยีที่ทันสมัย เพื่อการวินิจฉัยที่แม่นยำ
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>ทีมงานของเรา</h2>
                <p>บุคลากรที่มีความเชี่ยวชาญและประสบการณ์</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div
                        class="w-24 h-24 bg-gradient-to-r from-primary-500 to-sky-400 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-user-md text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">แพทย์เชี่ยวชาญ</h3>
                    <p class="text-gray-600">
                        แพทย์ที่ได้รับการรับรองและมีประสบการณ์ในสาขาความเชี่ยวชาญ
                    </p>
                </div>

                <div class="text-center">
                    <div
                        class="w-24 h-24 bg-gradient-to-r from-green-500 to-emerald-400 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-user-nurse text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">พยาบาลวิชาชีพ</h3>
                    <p class="text-gray-600">
                        ทีมพยาบาลที่ให้การดูแลด้วยความใส่ใจและมืออาชีพ
                    </p>
                </div>

                <div class="text-center">
                    <div
                        class="w-24 h-24 bg-gradient-to-r from-orange-500 to-red-400 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">เจ้าหน้าที่</h3>
                    <p class="text-gray-600">
                        บุคลากรที่มีความเชี่ยวชาญในแต่ละด้าน พร้อมให้บริการ
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>ทำไมต้องเลือกเรา</h2>
                <p>ข้อดีที่คุณจะได้รับจากการใช้บริการกับเรา</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-primary-500 to-sky-400 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">บริการรวดเร็ว</h3>
                            <p class="text-gray-600">ลดเวลารอคอย ด้วยระบบนัดหมายที่มีประสิทธิภาพ</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-400 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">มาตรฐานสูง</h3>
                            <p class="text-gray-600">ได้รับการรับรองมาตรฐานการแพทย์และความปลอดภัย</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-400 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-heart text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">ใส่ใจผู้ป่วย</h3>
                            <p class="text-gray-600">ดูแลผู้ป่วยด้วยความเอาใจใส่เหมือนคนในครอบครัว</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-400 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-award text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">ประสบการณ์ยาวนาน</h3>
                            <p class="text-gray-600">ประสบการณ์กว่า 15 ปีในการดูแลสุขภาพชุมชน</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-400 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-dollar-sign text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">ราคาสมเหตุสมผล</h3>
                            <p class="text-gray-600">บริการคุณภาพสูงในราคาที่เข้าถึงได้</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-400 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">ทำเลสะดวก</h3>
                            <p class="text-gray-600">ตั้งอยู่ในทำเลที่สะดวกในการเดินทาง พร้อมที่จอดรถ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-600 to-sky-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                พร้อมดูแลสุขภาพของคุณ
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                ติดต่อเราวันนี้ เพื่อนัดหมายหรือสอบถามข้อมูลเพิ่มเติม
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                    class="btn-primary bg-white text-primary-600 hover:bg-gray-100 text-lg px-8 py-4">
                    <i class="fas fa-phone mr-2"></i>
                    ติดต่อเรา
                </a>
                <a href="{{ route('doctors.index') }}"
                    class="btn-secondary bg-transparent border-white text-white hover:bg-white hover:text-primary-600 text-lg px-8 py-4">
                    <i class="fas fa-user-md mr-2"></i>
                    ดูทีมแพทย์
                </a>
            </div>
        </div>
    </section>
@endsection
