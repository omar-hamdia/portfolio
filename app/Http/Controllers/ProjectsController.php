<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }
}