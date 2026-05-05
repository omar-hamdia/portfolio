<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::with('ratings')->latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function show($slug)
    {
        $locale = session('locale', 'ar');
        app()->setLocale($locale);

        $project = Project::with('ratings')->where('slug', $slug)->firstOrFail();
        $project->increment('views_count');
        
        $relatedProjects = Project::with('ratings')->where('id', '!=', $project->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        
        $settings = \App\Models\Setting::first();

        return view('projects.show', compact('project', 'relatedProjects', 'settings'));
    }

    public function rate(Request $request, Project $project)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $ip = $request->ip();

        $existing = \App\Models\ProjectRating::where('project_id', $project->id)
            ->where('ip_address', $ip)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'لقد قمت بتقييم هذا المشروع مسبقاً.'
            ], 422);
        }

        \App\Models\ProjectRating::create([
            'project_id' => $project->id,
            'rating' => $request->rating,
            'ip_address' => $ip,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'شكراً لتقييمك!',
            'average_rating' => number_format($project->fresh()->average_rating, 1),
            'ratings_count' => $project->fresh()->ratings_count
        ]);
    }
}