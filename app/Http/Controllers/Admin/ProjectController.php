<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'images' => 'required|array|min:3',
            'images.*' => 'image|max:2048',
            'link' => 'nullable|url',
            'github' => 'nullable|url',
            'video' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:512000',
        ]);
    
        // إذا كان هناك صورة
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('projects/gallery', 'public');
            }
            $data['images'] = $images;
        }

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('projects/videos', 'public');
        }

        $data['github'] = $request->github;
    
        // توليد slug من العنوان
        $data['slug'] = Str::slug($request->title);
    
        Project::create($data);
    
        return redirect()->route('admin.projects.index')->with('success', 'تم إضافة المشروع بنجاح');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'images' => 'nullable|array|min:3',
            'images.*' => 'image|max:2048',
            'link' => 'nullable|url',
            'github' => 'nullable|url',
            'video' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:512000',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['github'] = $request->github;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('projects/gallery', 'public');
            }
            $data['images'] = $images;
        }

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('projects/videos', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'تم تعديل المشروع بنجاح');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'تم حذف المشروع بنجاح');
    }
}
