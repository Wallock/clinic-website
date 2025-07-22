🏥 คู่มือติดตั้ง Clinic Website
📋 ข้อกำหนดระบบ
เซิร์ฟเวอร์

PHP: >= 7.4 (แนะนำ PHP 8.0+)
Web Server: Apache 2.4+ หรือ Nginx 1.18+
Database: MySQL 5.7+ หรือ MariaDB 10.3+
Memory: อย่างน้อย 512MB RAM

เครื่องมือพัฒนา

Composer: เวอร์ชันล่าสุด
Node.js: >= 14.x
NPM: >= 6.x หรือ Yarn

🚀 ขั้นตอนการติดตั้ง

1. เตรียมไฟล์โปรเจค
   bash# แตกไฟล์ ZIP ที่ได้รับ
   unzip clinic-website.zip
   cd clinic-website

# หรือ Clone จาก Git Repository (ถ้ามี)

git clone <repository-url> clinic-website
cd clinic-website 2. ติดตั้ง Dependencies
bash# ติดตั้ง PHP Dependencies
composer install

# ติดตั้ง Node.js Dependencies

npm install

# หรือใช้ Yarn

yarn install 3. การตั้งค่า Environment
bash# คัดลอกไฟล์ environment
cp .env.example .env

# สร้าง Application Key

php artisan key:generate 4. แก้ไขไฟล์ .env
เปิดไฟล์ .env และแก้ไขข้อมูลต่อไปนี้:
env# ข้อมูลแอปพลิเคชัน
APP_NAME="คลีนิกของคุณ"
APP_ENV=production # เปลี่ยนเป็น production สำหรับการใช้งานจริง
APP_DEBUG=false # เปลี่ยนเป็น false สำหรับการใช้งานจริง
APP_URL=https://yourdomain.com

# ฐานข้อมูล

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinic_db
DB_USERNAME=your_username
DB_PASSWORD=your_password

# อีเมล (สำหรับการส่งอีเมล)

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# ข้อมูลคลีนิก

CLINIC_NAME="คลีนิกของคุณ"
CLINIC_PHONE="02-xxx-xxxx"
CLINIC_EMAIL="info@yourdomain.com"
CLINIC_ADDRESS="ที่อยู่คลีนิกของคุณ" 5. สร้างและตั้งค่าฐานข้อมูล
bash# สร้างฐานข้อมูล (ใน MySQL)
mysql -u root -p
CREATE DATABASE clinic_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# รัน Migrations

php artisan migrate

# เพิ่มข้อมูลเริ่มต้น

php artisan db:seed 6. การตั้งค่า Storage
bash# สร้าง Storage Link สำหรับไฟล์ที่อัพโหลด
php artisan storage:link

# ตั้งค่าสิทธิ์โฟลเดอร์

chmod -R 775 storage
chmod -R 775 bootstrap/cache 7. Build Assets
bash# สำหรับ Development
npm run dev

# สำหรับ Production

npm run build

# สำหรับการพัฒนาแบบ Watch

npm run watch 8. เริ่มเซิร์ฟเวอร์
bash# Development Server
php artisan serve

# เว็บไซต์จะทำงานที่: http://localhost:8000

🔧 การตั้งค่า Web Server
Apache Configuration
สร้างไฟล์ .htaccess ในโฟลเดอร์ public/:
apache<IfModule mod_rewrite.c>
<IfModule mod_negotiation.c>
Options -MultiViews -Indexes
</IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]

</IfModule>
Nginx Configuration
nginxserver {
    listen 80;
    server_name yourdomain.com;
    root /path/to/clinic-website/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

}
👤 ข้อมูลผู้ดูแลระบบเริ่มต้น
หลังจากรัน php artisan db:seed แล้ว คุณสามารถเข้าสู่ระบบด้วย:

URL: /login
Email: admin@clinic.com
Password: password

⚠️ สำคัญ: เปลี่ยนรหัสผ่านทันทีหลังจากเข้าสู่ระบบครั้งแรก!
🔒 การตั้งค่าความปลอดภัย

1. เปลี่ยนค่าเริ่มต้น
   bash# เปลี่ยนรหัสผ่าน Admin
   php artisan tinker
    > $user = App\Models\User::where('email', 'admin@clinic.com')->first();
> $user->password = Hash::make('รหัสผ่านใหม่ที่ปลอดภัย');
    > $user->save();
    > exit
2. ตั้งค่า SSL Certificate
   bash# ติดตั้ง Let's Encrypt (Ubuntu/Debian)
   sudo apt install certbot python3-certbot-apache

# สร้าง SSL Certificate

sudo certbot --apache -d yourdomain.com 3. ปิด Debug Mode (Production)
envAPP_ENV=production
APP_DEBUG=false
📊 การตั้งค่าการสำรองข้อมูล

1. ติดตั้ง Laravel Backup Package
   bashcomposer require spatie/laravel-backup
   php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
2. ตั้งค่า Cron Job
   bash# เพิ่มใน crontab
   crontab -e

# เพิ่มบรรทัดนี้

0 2 \* \* \* cd /path/to/clinic-website && php artisan backup:run --only-db
🚀 การปรับแต่งประสิทธิภาพ

1. Enable Caching
   bash# Config Cache
   php artisan config:cache

# Route Cache

php artisan route:cache

# View Cache

php artisan view:cache

# Event Cache

php artisan event:cache 2. Optimize Composer
bashcomposer install --optimize-autoloader --no-dev 3. ตั้งค่า Queue Worker
bash# เรียกใช้ Queue Worker
php artisan queue:work

# หรือใช้ Supervisor สำหรับ Production

🐛 การแก้ไขปัญหาที่อาจเจอ
ปัญหา Permission
bashsudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
ปัญหา Composer Memory
bashphp -d memory_limit=-1 /usr/local/bin/composer install
ปัญหา Node.js
bash# ล้าง cache
npm cache clean --force
rm -rf node_modules
npm install
📱 การตั้งค่าเพิ่มเติม

1. การตั้งค่าภาษา
   แก้ไขไฟล์ config/app.php:
   php'timezone' => 'Asia/Bangkok',
   'locale' => 'th',
   'fallback_locale' => 'en',
2. การตั้งค่าอีเมล Template
   คุณสามารถปรับแต่ง Email Templates ได้ที่:

resources/views/emails/

3. การเพิ่มข้อมูลตัวอย่าง
   bash# รันเฉพาะ Seeder ที่ต้องการ
   php artisan db:seed --class=DoctorSeeder
   php artisan db:seed --class=ServiceSeeder
   php artisan db:seed --class=ArticleSeeder
   🔄 การอัพเดต
   bash# Pull ข้อมูลใหม่จาก Git
   git pull origin main

# อัพเดต Dependencies

composer install --no-dev
npm install

# รัน Migrations ใหม่

php artisan migrate

# Build Assets ใหม่

npm run build

# Clear Cache

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
📞 การสนับสนุน
หากพบปัญหาในการติดตั้งหรือการใช้งาน:

ตรวจสอบ Log ไฟล์: storage/logs/laravel.log
ตรวจสอบ Web Server Error Log
ตรวจสอบข้อกำหนดระบบ
ติดต่อทีมสนับสนุน

✅ เช็คลิสต์การติดตั้ง

PHP และ Extensions ติดตั้งครบ
Composer ติดตั้งแล้ว
Node.js และ NPM ติดตั้งแล้ว
ฐานข้อมูลสร้างและเชื่อมต่อได้
ไฟล์ .env ตั้งค่าถูกต้อง
Migrations รันสำเร็จ
Seeders รันสำเร็จ
Storage link สร้างแล้ว
Assets build สำเร็จ
เข้าสู่ระบบ Admin ได้
Web Server ตั้งค่าแล้ว
SSL Certificate ติดตั้งแล้ว (สำหรับ Production)

🎉 ขอแสดงความยินดี! ระบบเว็บไซต์คลีนิกของคุณพร้อมใช้งานแล้ว
