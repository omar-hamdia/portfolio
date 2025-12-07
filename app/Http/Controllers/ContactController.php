<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
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

    // (اختياري) دالة إرسال الإيميل
    private function sendNotificationEmail($data)
    {
        Mail::send('emails.contact-notification', $data, function($message) use ($data) {
            $message->to('admin@example.com')
                    ->subject('رسالة جديدة من نموذج الاتصال: ' . $data['subject'])
                    ->replyTo($data['email'], $data['name']);
        });
    }
}