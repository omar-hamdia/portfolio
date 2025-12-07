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
        $data = $request->all();
    
        // إذا كان هناك صورة
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('projects/videos', 'public');
        }
        $data['github'] = $request->github;
    
        // توليد slug من العنوان
        $data['slug'] = Str::slug($request->title);
    
        Project::create($data);
    
        return redirect()->route('projects.index')->with('success', 'تم إضافة المشروع بنجاح');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
        ]);

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'تم تعديل المشروع بنجاح');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'تم حذف المشروع بنجاح');
    }
}
