<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;

class IndexController extends Controller
{
    public function index()
    {
        $menuItems = [
            ['title' => 'Home', 'link' => '#hero', 'icon' => 'bi bi-house navicon'],
            ['title' => 'About', 'link' => '#about', 'icon' => 'bi bi-person navicon'],
            ['title' => 'Resume', 'link' => '#resume', 'icon' => 'bi bi-file-earmark-text navicon'],
            ['title' => 'Portfolio', 'link' => '#portfolio', 'icon' => 'bi bi-images navicon'],
            ['title' => 'Services', 'link' => '#services', 'icon' => 'bi bi-hdd-stack navicon'],
            ['title' => 'Contact', 'link' => '#contact', 'icon' => 'bi bi-envelope navicon'],
        ];

        $hero = [
            'name' => 'Brandon Johnson',
            'roles' => ['Designer', 'Developer', 'Freelancer', 'Photographer'],
            'background' => 'assets/img/hero-bg.jpg',
            'social' => [
                ['icon' => 'bi bi-twitter-x', 'link' => '#'],
                ['icon' => 'bi bi-facebook', 'link' => '#'],
                ['icon' => 'bi bi-instagram', 'link' => '#'],
                ['icon' => 'bi bi-linkedin', 'link' => '#'],
            ],
        ];

        $about = [
            'description' => 'Magnam dolores commodi suscipit...',
            'profileImage' => 'assets/img/profile-img.jpg',
            'title' => 'UI/UX Designer & Web Developer.',
            'subtitle' => 'Lorem ipsum dolor sit amet...',
            'info' => [
                [
                    ['label' => 'Birthday', 'value' => '1 May 1995'],
                    ['label' => 'Website', 'value' => 'www.example.com'],
                    ['label' => 'Phone', 'value' => '+123 456 7890'],
                    ['label' => 'City', 'value' => 'New York, USA'],
                ],
                [
                    ['label' => 'Age', 'value' => '30'],
                    ['label' => 'Degree', 'value' => 'Master'],
                    ['label' => 'Email', 'value' => 'email@example.com'],
                    ['label' => 'Freelance', 'value' => 'Available'],
                ],
            ],
            'longDescription' => 'Officiis eligendi itaque labore et dolorum mollitia...',
        ];

        return view('site.index', compact('menuItems', 'hero', 'about'));
    }
}
