<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\About;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // تنظيف الجداول أولاً (اختياري)
        Setting::truncate();
        About::truncate();
        Project::truncate();
        Service::truncate();
        Testimonial::truncate();

        // 1. إنشاء إعدادات الموقع
        Setting::create([
            'site_name' => 'عمر.ديف',
            'email' => 'contact@omar.dev',
            'phone' => '+966501234567',
            'social_links' => [
                'twitter' => 'https://twitter.com/omar',
                'facebook' => 'https://facebook.com/omar.dev',
                'instagram' => 'https://instagram.com/omar.dev',
                'linkedin' => 'https://linkedin.com/in/omar',
                'github' => 'https://github.com/omar',
                'youtube' => 'https://youtube.com/@omar'
            ],
            'dark_mode' => false,
        ]);

        // 2. إنشاء قسم "من أنا"
        About::create([
            'content' => '<h2>مطور ويب متكامل</h2>
                         <p class="fst-italic py-3">أنا مطور ويب متخصص في إنشاء تطبيقات ويب مبتكرة باستخدام أحدث التقنيات.</p>
                         <div class="row">
                            <div class="col-lg-6">
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <strong>الموقع:</strong> <span>www.omar.dev</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>الهاتف:</strong> <span>+966 50 123 4567</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>المدينة:</strong> <span>الرياض، السعودية</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <strong>المؤهل:</strong> <span>بكالوريوس علوم حاسب</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>البريد الإلكتروني:</strong> <span>contact@omar.dev</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>العمل الحر:</strong> <span>متاح</span></li>
                                </ul>
                            </div>
                         </div>
                         <p class="py-3">
                            متخصص في إنشاء حلول ويب مبتكرة باستخدام Laravel و Vue.js والإطارات الحديثة.
                            لدي خبرة تزيد عن 3 سنوات في تطوير تطبيقات الويب والتطبيقات المتكاملة.
                            ملتزم بتقديم تطبيقات عالية الجودة وقابلة للتطوير تلبي احتياجات العملاء.
                         </p>',
            'image' => null,
        ]);

        // 3. إنشاء المشاريع
        $projects = [
            [
                'title' => 'منصة تجارة إلكترونية',
                'slug' => 'ecommerce-platform',
                'description' => 'منصة تسوق إلكتروني متكاملة مع نظام إدارة المخزون والمدفوعات.',
                'image' => 'projects/ecommerce.jpg',
                'video' => 'https://youtube.com/watch?v=example1',
                'github' => 'https://github.com/omar/ecommerce',
                'link' => 'https://demo.omar.dev/ecommerce',
            ],
            [
                'title' => 'تطبيق إدارة المهام',
                'slug' => 'task-management-app',
                'description' => 'تطبيق لإدارة المهام اليومية مع ميزات التعاون والتذكيرات.',
                'image' => 'projects/taskapp.jpg',
                'video' => 'https://youtube.com/watch?v=example2',
                'github' => 'https://github.com/omar/taskapp',
                'link' => 'https://demo.omar.dev/taskapp',
            ],
            [
                'title' => 'نظام حجز مواعيد',
                'slug' => 'booking-system',
                'description' => 'نظام متكامل لحجز المواعيد عبر الإنترنت مع إشعارات وتقارير.',
                'image' => 'projects/booking.jpg',
                'video' => 'https://youtube.com/watch?v=example3',
                'github' => 'https://github.com/omar/booking',
                'link' => 'https://demo.omar.dev/booking',
            ],
            [
                'title' => 'منصة تعليمية',
                'slug' => 'learning-platform',
                'description' => 'منصة تعليمية متكاملة مع نظام إدارة المحتوى والتقييمات.',
                'image' => 'projects/learning.jpg',
                'video' => 'https://youtube.com/watch?v=example4',
                'github' => 'https://github.com/omar/learning',
                'link' => 'https://demo.omar.dev/learning',
            ],
            [
                'title' => 'تطبيق الطقس',
                'slug' => 'weather-app',
                'description' => 'تطبيق يعرض أحوال الطقس الحالية والتوقعات للمدن المختلفة.',
                'image' => 'projects/weather.jpg',
                'video' => 'https://youtube.com/watch?v=example5',
                'github' => 'https://github.com/omar/weather',
                'link' => 'https://demo.omar.dev/weather',
            ],
            [
                'title' => 'مدونة تقنية',
                'slug' => 'tech-blog',
                'description' => 'مدونة متكاملة لنشر المقالات التقنية مع نظام التعليقات.',
                'image' => 'projects/blog.jpg',
                'video' => 'https://youtube.com/watch?v=example6',
                'github' => 'https://github.com/omar/blog',
                'link' => 'https://demo.omar.dev/blog',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // 4. إنشاء الخدمات
        $services = [
            [
                'title' => 'تطوير الويب',
                'description' => 'تطوير تطبيقات ويب باستخدام أحدث التقنيات مثل Laravel و Vue.js',
                'icon' => 'code-slash'
            ],
            [
                'title' => 'تصميم UI/UX',
                'description' => 'تصميم واجهات مستخدم جذابة وتجربة مستخدم محسنة',
                'icon' => 'palette'
            ],
            [
                'title' => 'تطبيقات الجوال',
                'description' => 'تطوير تطبيقات جوال متعددة المنصات باستخدام Flutter و React Native',
                'icon' => 'phone'
            ],
            [
                'title' => 'حلول التجارة الإلكترونية',
                'description' => 'بناء منصات تسوق إلكتروني متكاملة مع أنظمة الدفع',
                'icon' => 'cart'
            ],
            [
                'title' => 'تطوير API',
                'description' => 'بناء واجهات برمجة تطبيقات RESTful وتكامل الأنظمة',
                'icon' => 'plug'
            ],
            [
                'title' => 'الصيانة والدعم',
                'description' => 'صيانة مستمرة ودعم فني للتطبيقات الحالية',
                'icon' => 'tools'
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // 5. إنشاء التوصيات
        $testimonials = [
            [
                'name' => 'أحمد محمد',
                'role' => 'مدير شركة تقنية',
                'message' => 'عمل ممتاز وتنفيذ دقيق للمشروع. عمر مبدع وملتزم بمواعيد التسليم.',
                'avatar' => 'testimonials/ahmed.jpg'
            ],
            [
                'name' => 'سارة عبدالله',
                'role' => 'رائدة أعمال',
                'message' => 'ساعدني عمر في بناء تطبيق أعمالي من الصفر. محترف وملتزم بالجودة.',
                'avatar' => 'testimonials/sara.jpg'
            ],
            [
                'name' => 'خالد فهد',
                'role' => 'مدير مشروع',
                'message' => 'تعاملت مع عمر في عدة مشاريع، دائمًا يقدم حلولًا مبتكرة وجودة عالية.',
                'avatar' => 'testimonials/khaled.jpg'
            ],
            [
                'name' => 'نورة سعود',
                'role' => 'مصممة UX',
                'message' => 'تعاون رائع مع عمر في مشاريع مشتركة. مبدع ولديه فهم عميق للمستخدم.',
                'avatar' => 'testimonials/nora.jpg'
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        $this->command->info('تم إنشاء بيانات الملف الشخصي بنجاح!');
    }
}