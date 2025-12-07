<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;   // ✔ مهم جداً
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('admin.about.index', compact('about')); // ✔ داخل مجلد Admin
    }

    public function create()
    {
        return view('admin.about.create'); // ✔
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:5000',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('content');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        About::create($data);

        return redirect()->route('admin.about.index')->with('success', 'تم إضافة المحتوى بنجاح');
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $request->validate([
            'content' => 'required|max:5000',
            'image' => 'nullable|image|max:2048',
        ]);

        $about->content = $request->content;

        if ($request->hasFile('image')) {
            $about->image = $request->file('image')->store('about', 'public');
        }

        $about->save();

        return redirect()->route('admin.about.index')->with('success', 'تم تحديث المحتوى بنجاح');
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);
        $about->delete();

        return redirect()->route('admin.about.index')->with('success', 'تم حذف المحتوى بنجاح');
    }
}
