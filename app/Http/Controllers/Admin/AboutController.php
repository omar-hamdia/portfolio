<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    
    public function index()
    {
        $about = About::first();
        return view('admin.about.index', compact('about'));
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'content' => 'required|string',
            'content_en' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'image_en' => 'nullable|image|max:2048',
            'cv' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        if ($request->hasFile('image_en')) {
            $data['image_en'] = $request->file('image_en')->store('about', 'public');
        }

        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('about/cv', 'public');
        }

        About::create($data);

        return redirect()->route('admin.about.index')->with('success', 'تم إضافة المعلومات بنجاح');
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'content' => 'required|string',
            'content_en' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'image_en' => 'nullable|image|max:2048',
            'cv' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        if ($request->hasFile('image_en')) {
            $data['image_en'] = $request->file('image_en')->store('about', 'public');
        }

        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('about/cv', 'public');
        }

        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'تم تحديث المعلومات بنجاح');
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);
        $about->delete();

        return redirect()->route('admin.about.index')->with('success', 'تم حذف المحتوى بنجاح');
    }
}
