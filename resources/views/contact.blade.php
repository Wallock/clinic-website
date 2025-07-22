@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-sky-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">ติดต่อเรา</h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                    พร้อมให้บริการและตอบคำถามของคุณ ติดต่อเราได้ทุกวัน
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Form & Info Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white rounded-2xl shadow-soft p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">ส่งข้อความถึงเรา</h2>

                    <form class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">ชื่อ</label>
                                <input type="text" id="first_name" name="first_name" class="input-field"
                                    placeholder="กรอกชื่อของคุณ" required>
                            </div>
                            <div>
                                <label for="last_name"
                                    class="block text-sm font-semibold text-gray-700 mb-2">นามสกุล</label>
                                <input type="text" id="last_name" name="last_name" class="input-field"
                                    placeholder="กรอกนามสกุลของคุณ" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">อีเมล</label>
                                <input type="email" id="email" name="email" class="input-field"
                                    placeholder="example@email.com" required>
                            </div>
                            <div>
                                <label for="phone"
                                    class="block text-sm font-semibold text-gray-700 mb-2">เบอร์โทร</label>
                                <input type="tel" id="phone" name="phone" class="input-field"
                                    placeholder="08x-xxx-xxxx">
                            </div>
                        </div>

                        <div>
                            <label for="service"
                                class="block text-sm font-semibold text-gray-700 mb-2">บริการที่สนใจ</label>
                            <select id="service" name="service" class="input-field">
                                <option value="">เลือกบริการ</option>
                                <option value="general">ตรวจสุขภาพทั่วไป</option>
                                <option value="consultation">ปรึกษาแพทย์</option>
                                <option value="treatment">การรักษา</option>
                                <option value="vaccine">วัคซีน</option>
                                <option value="other">อื่นๆ</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">ข้อความ</label>
                            <textarea id="message" name="message" rows="5" class="textarea-field"
                                placeholder="กรอกข้อความที่ต้องการสอบถาม..." required></textarea>
                        </div>

                        <div class="flex items-center">
                            <input id="privacy" name="privacy" type="checkbox"
                                class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2"
                                required>
                            <label for="privacy" class="ml-2 text-sm text-gray-600">
                                ยอมรับ <a href="#" class="text-primary-600 hover:underline">เงื่อนไขการใช้งาน</a> และ
                                <a href="#" class="text-primary-600 hover:underline">นโยบายความเป็นส่วนตัว</a>
                            </label>
                        </div>

                        <button type="submit" class="w-full btn-primary text-lg py-4">
                            <i class="fas fa-paper-plane mr-2"></i>
                            ส่งข้อความ
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="space-y-8">
                    <!-- Contact Details -->
                    <div class="bg-white rounded-2xl shadow-soft p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">ข้อมูลติดต่อ</h2>

                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-primary-500 to-sky-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">ที่อยู่</h3>
                                    <p class="text-gray-600">
                                        123 ถนนสุขภาพดี<br>
                                        แขวงคลีนิก เขตดูแล<br>
                                        กรุงเทพมหานคร 10110
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">โทรศัพท์</h3>
                                    <p class="text-gray-600">
                                        <a href="tel:02-xxx-xxxx"
                                            class="hover:text-primary-600 transition-colors">02-xxx-xxxx</a><br>
                                        <a href="tel:08x-xxx-xxxx"
                                            class="hover:text-primary-600 transition-colors">08x-xxx-xxxx</a>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">อีเมล</h3>
                                    <p class="text-gray-600">
                                        <a href="mailto:info@clinic.com"
                                            class="hover:text-primary-600 transition-colors">info@clinic.com</a><br>
                                        <a href="mailto:appointment@clinic.com"
                                            class="hover:text-primary-600 transition-colors">appointment@clinic.com</a>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">เวลาทำการ</h3>
                                    <div class="text-gray-600 space-y-1">
                                        <p>จันทร์ - ศุกร์: 08:00 - 18:00 น.</p>
                                        <p>เสาร์: 08:00 - 16:00 น.</p>
                                        <p>อาทิตย์: 09:00 - 15:00 น.</p>
                                        <p class="text-red-600 font-medium">วันหยุดนักขัตฤกษ์: ปิด</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="bg-gradient-to-r from-red-500 to-pink-600 rounded-2xl shadow-soft p-8 text-white">
                        <h2 class="text-2xl font-bold mb-4">
                            <i class="fas fa-ambulance mr-2"></i>
                            กรณีฉุกเฉิน
                        </h2>
                        <p class="text-red-100 mb-4">
                            สำหรับกรณีฉุกเฉินนอกเวลาทำการ กรุณาติดต่อ
                        </p>
                        <div class="space-y-2">
                            <p class="text-xl font-bold">
                                <i class="fas fa-phone mr-2"></i>
                                <a href="tel:1669" class="hover:text-red-200 transition-colors">1669
                                    (ฉุกเฉินทางการแพทย์)</a>
                            </p>
                            <p class="text-lg">
                                <i class="fas fa-mobile-alt mr-2"></i>
                                <a href="tel:08x-xxx-xxxx" class="hover:text-red-200 transition-colors">08x-xxx-xxxx
                                    (แพทย์เวร)</a>
                            </p>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="bg-white rounded-2xl shadow-soft p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">ติดตามเราได้ที่</h2>

                        <div class="grid grid-cols-2 gap-4">
                            <a href="#"
                                class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors group">
                                <div
                                    class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fab fa-facebook-f text-white"></i>
                                </div>
                                <span class="font-medium text-gray-700">Facebook</span>
                            </a>

                            <a href="#"
                                class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors group">
                                <div
                                    class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fab fa-line text-white"></i>
                                </div>
                                <span class="font-medium text-gray-700">LINE</span>
                            </a>

                            <a href="#"
                                class="flex items-center space-x-3 p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors group">
                                <div
                                    class="w-10 h-10 bg-pink-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fab fa-instagram text-white"></i>
                                </div>
                                <span class="font-medium text-gray-700">Instagram</span>
                            </a>

                            <a href="#"
                                class="flex items-center space-x-3 p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors group">
                                <div
                                    class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fab fa-youtube text-white"></i>
                                </div>
                                <span class="font-medium text-gray-700">YouTube</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>แผนที่คลีนิก</h2>
                <p>ตำแหน่งที่ตั้งและเส้นทางการเดินทาง</p>
            </div>

            <div class="bg-gray-200 rounded-2xl h-96 flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-map-marked-alt text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">แผนที่ Google Maps</h3>
                    <p class="text-gray-500">แผนที่จะแสดงที่นี่เมื่อเชื่อมต่อ Google Maps API</p>
                </div>
            </div>

            <!-- Directions -->
            <div class="mt-12 grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-2xl p-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-400 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-car text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">เดินทางโดยรถยนต์</h3>
                    <p class="text-gray-600">มีที่จอดรถสะดวก บริเวณหน้าอาคาร และถนนข้างเคียง</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-400 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-subway text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">เดินทางโดย BTS</h3>
                    <p class="text-gray-600">สถานีใกล้เคียง: สถานี XXX (เดิน 5 นาที)</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-400 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-bus text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">เดินทางโดยรถเมล์</h3>
                    <p class="text-gray-600">สาย 1, 25, 40 ผ่านหน้าคลีนิก</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>คำถามที่พบบ่อย</h2>
                <p>คำตอบสำหรับคำถามที่ผู้ป่วยสอบถามบ่อยๆ</p>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-soft p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">ต้องนัดหมายก่อนหรือไม่?</h3>
                    <p class="text-gray-600">
                        แนะนำให้นัดหมายล่วงหน้าเพื่อลดเวลารอคอย แต่เรารับ Walk-in ได้ในกรณีที่ไม่เร่งด่วน
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-soft p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">รับประกันสังคมหรือไม่?</h3>
                    <p class="text-gray-600">
                        เรารับประกันสังคม ประกันสุขภาพแห่งชาติ และประกันเอกชนหลายบริษัท
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-soft p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">มีบริการตรวจสุขภาพแบบครบวงจรหรือไม่?</h3>
                    <p class="text-gray-600">
                        มี เรามีแพ็คเกจตรวจสุขภาพหลายระดับ ตั้งแต่พื้นฐานไปจนถึงระดับพรีเมี่ยม
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-soft p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">สามารถยกเลิกนัดหมายได้หรือไม่?</h3>
                    <p class="text-gray-600">
                        สามารถยกเลิกหรือเปลี่ยนแปลงนัดหมายได้ กรุณาแจ้งล่วงหน้าอย่างน้อย 2 ชั่วโมง
                    </p>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Form submission handling
            document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault();

                // Show success message (replace with actual form submission)
                alert('ขอบคุณสำหรับข้อความ เราจะติดต่อกลับโดยเร็วที่สุด');

                // Reset form
                this.reset();
            });
        </script>
    @endpush
@endsection
