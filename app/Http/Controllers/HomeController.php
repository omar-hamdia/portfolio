<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\About;
use App\Models\Setting;
use App\Models\ContactMessage;
use App\Models\SiteVisit;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // تسجيل الزيارة
        SiteVisit::firstOrCreate([
            'ip' => $request->ip(),
            'visited_at' => Carbon::today(),
        ]);

        $locale = session('locale', 'ar');
        app()->setLocale($locale);
        
        $settings = Setting::first();
        
        $data = [
            'projects'     => Project::with('ratings')->latest()->get(),
            'services'     => Service::all(),
            'testimonials' => Testimonial::all(),
            'about'        => About::first(),
            'settings'     => $settings,
            'locale'       => $locale,
        ];
        
        return view('frontend.index', $data);
    }

    public function en(Request $request)
    {
        session(['locale' => 'en']);
        return redirect()->route('home');
    }
    
    public function switchLang($lang)
    {
        if (in_array($lang, ['en', 'ar'])) {
            session(['locale' => $lang]);
        }
        
        return redirect()->back()->withInput();
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