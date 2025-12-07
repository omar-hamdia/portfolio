<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\About;
use App\Models\Setting;
use App\Models\ContactMessage;

class HomeController extends Controller
{
    public function index(Request $request)
{
    // تحقق من الجلسة أو استخدم 'en' كافتراضي
    $locale = session('locale', 'en');
    
    // روابط السوشيال ميديا (عدّلها كما تريد)
    $socialLinks = [
        'facebook'  => 'https://www.facebook.com/profile.php?id=61558584693394',
        'linkedin'  => 'https://www.linkedin.com/in/omar-hamdia-541021369/',
        'instagram' => 'https://www.instagram.com/hamdia5824/',
        'github'    => 'https://github.com/omar-hamdia',
        'twitter'   => 'https://x.com/omarHamdia41569',
    ];
    

    // تحميل البيانات مرة واحدة
    $data = [
        'projects'     => Project::all(),
        'services'     => Service::all(),
        'testimonials' => Testimonial::all(),
        'about'        => About::first(),
        'settings'     => Setting::first(),
        'socialLinks'  => $socialLinks, // ← أضفناه هنا
    ];
    
    return view('frontend.index', $data);
}

    public function en(Request $request)
    {
        // تحقق من الجلسة أو استخدم 'en' كافتراضي
        $locale = session('locale', 'en');
        
        // تحميل البيانات مرة واحدة
        $data = [
            'projects' => Project::all(),
            'services' => Service::all(),
            'testimonials' => Testimonial::all(),
            'about' => About::first(),
            'settings' => Setting::first(),
        ];
        
        // للتحقق من البيانات (افتح console في المتصفح)
        // dd($data);
        
        
             return view('frontend.index_en', $data);
        
    }
    
    public function switchLang($lang)
    {
        if (in_array($lang, ['en', 'ar'])) {
            session(['locale' => $lang]);
        }
        
        return redirect()->route('home');
    }
    public function store(Request $request)
    {
        // تحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // حفظ الرسالة في قاعدة البيانات
        ContactMessage::create($validated);

        // (اختياري) إرسال إيميل تنبيه
        // $this->sendNotificationEmail($validated);

        return response()->json([
            'success' => true,
            'message' => 'شكراً لتواصلك! سنرد عليك قريباً.'
        ]);
    }

}