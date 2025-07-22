<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get admin user for articles
        $adminUser = User::where('email', 'admin@clinic.com')->first();
        $doctorUser = User::where('email', 'doctor@clinic.com')->first();
        $writerUser = User::where('email', 'writer@clinic.com')->first();

        // Use admin user if others don't exist
        if (!$adminUser) {
            $adminUser = User::first();
        }

        if (!$doctorUser) {
            $doctorUser = $adminUser;
        }

        if (!$writerUser) {
            $writerUser = $adminUser;
        }

        $articles = [
            [
                'title' => '5 วิธีดูแลสุขภาพในช่วงฤดูฝน',
                'slug' => '5-ways-to-stay-healthy-in-rainy-season',
                'excerpt' => 'เคล็ดลับการดูแลสุขภาพให้แข็งแรงในช่วงฤดูฝน ป้องกันการเจ็บป่วยจากการเปลี่ยนแปลงของอากาศ',
                'content' => 'ช่วงฤดูฝนเป็นช่วงเวลาที่ร่างกายต้องปรับตัวกับการเปลี่ยนแปลงของอากาศ การดูแลสุขภาพให้เหมาะสมจึงเป็นสิ่งสำคัญ

**1. ดื่มน้ำให้เพียงพอ**
แม้ว่าอากาศจะเย็นสบาย แต่ร่างกายยังคงต้องการน้ำในปริมาณที่เพียงพอ ดื่มน้ำอย่างน้อย 8-10 แก้วต่อวัน เพื่อช่วยขับของเสียออกจากร่างกายและเสริมสร้างภูมิคุ้มกัน

**2. รับประทานอาหารที่มีวิตามินซี**
วิตามินซีช่วยเสริมสร้างภูมิคุ้มกัน ป้องกันการติดเชื้อ ควรรับประทานผลไม้และผักที่มีวิตามินซีสูง เช่น ส้ม มะนาว กีวี่ มะเขือเทศ และพริกหวาน

**3. ออกกำลังกายสม่ำเสมอ**
แม้ว่าจะฝนตก แต่ไม่ควรหยุดออกกำลังกาย สามารถเลือกออกกำลังกายในร่ม หรือเมื่อฝนหยุดตก การออกกำลังกายช่วยเสริมสร้างภูมิต้านทานโรค

**4. นอนหลับให้เพียงพอ**
การพักผ่อนที่เพียงพอช่วยให้ระบบภูมิคุ้มกันทำงานได้อย่างมีประสิทธิภาพ ควรนอนหลับ 7-8 ชั่วโมงต่อคืน และนอนให้ตรงเวลา

**5. รักษาความสะอาด**
ล้างมือบ่อยๆ โดยเฉพาะหลังจากสัมผัสสิ่งของต่างๆ ใช้แอลกอฮอล์เจลทำความสะอาดมือ และหลีกเลี่ยงการจับหน้าโดยไม่จำเป็น

การปฏิบัติตามคำแนะนำเหล่านี้จะช่วยให้คุณผ่านช่วงฤดูฝนไปได้อย่างมีสุขภาพดี',
                'category' => 'สุขภาพทั่วไป',
                'tags' => ['ฤดูฝน', 'ป้องกันโรค', 'สุขภาพ', 'ภูมิคุ้มกัน'],
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'user_id' => $adminUser->id,
                'reading_time' => 3,
                'views_count' => 245,
                'meta_description' => 'เรียนรู้ 5 วิธีง่ายๆ ในการดูแลสุขภาพในช่วงฤดูฝน ป้องกันโรคและเสริมสร้างภูมิคุ้มกัน',
                'meta_keywords' => 'สุขภาพฤดูฝน, ป้องกันโรค, ภูมิคุ้มกัน, วิตามินซี'
            ],
        ];

        foreach ($articles as $article) {
            // Ensure slug is unique
            $originalSlug = $article['slug'];
            $counter = 1;

            while (Article::where('slug', $article['slug'])->exists()) {
                $article['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }

            Article::create($article);
        }

        $this->command->info('✅ Article seeded successfully!');
    }
}
