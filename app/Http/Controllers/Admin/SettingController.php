<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first(); // عادة هناك سجل واحد فقط
        return view('admin.settings.index', compact('settings'));
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
            'social_links' => 'nullable|array',
            'dark_mode' => 'nullable|boolean',
        ]);

        $data['dark_mode'] = $request->has('dark_mode');

        $setting->update($data);

        return redirect()->route('admin.settings.index')->with('success', 'تم تحديث الإعدادات بنجاح.');
    }
}
