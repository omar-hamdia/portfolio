<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\SiteVisit;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects_count' => Project::count(),
            'services_count' => Service::count(),
            'testimonials_count' => Testimonial::count(),
            'total_visits' => SiteVisit::count(),
            'today_visits' => SiteVisit::whereDate('visited_at', now()->today())->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
