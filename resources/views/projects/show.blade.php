<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $project->title }} - {{ config('app.name') }}</title>
    
    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    
    <!-- Fonts -->
    @if(app()->getLocale() == 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @else
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @endif
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
        }
        
        body {
            font-family: {{ app()->getLocale() == 'ar' ? "'Cairo', sans-serif" : "'Poppins', sans-serif" }};
            line-height: 1.8;
            color: #333;
        }
        
        [dir="rtl"] {
            text-align: right;
        }
        
        [dir="ltr"] {
            text-align: left;
        }
        
        .project-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0056b3 100%);
            color: white;
            padding: 80px 0;
            margin-bottom: 50px;
        }
        
        .project-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .project-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 14px;
        }
        
        .project-image {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .project-image img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .project-image img:hover {
            transform: scale(1.02);
        }
        
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 15px;
            margin: 30px 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .project-content {
            font-size: 1.1rem;
            line-height: 1.9;
        }
        
        .project-content h2, 
        .project-content h3, 
        .project-content h4 {
            color: var(--primary-color);
            margin-top: 30px;
            margin-bottom: 15px;
        }
        
        .project-content ul, 
        .project-content ol {
            padding-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 20px;
            margin-bottom: 20px;
        }
        
        .tech-stack {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
        }
        
        .tech-tag {
            background: var(--light-bg);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .project-links {
            display: flex;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        
        .project-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .project-link.live {
            background: var(--primary-color);
            color: white;
        }
        
        .project-link.github {
            background: #333;
            color: white;
        }
        
        .project-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .related-projects {
            background: var(--light-bg);
            padding: 80px 0;
            margin-top: 80px;
        }
        
        .related-project-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .related-project-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .related-project-img {
            height: 200px;
            overflow: hidden;
        }
        
        .related-project-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .related-project-card:hover .related-project-img img {
            transform: scale(1.1);
        }
        
        .related-project-content {
            padding: 25px;
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 25px;
            background: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 30px;
        }
        
        .back-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }
        
        @media (max-width: 768px) {
            .project-title {
                font-size: 2rem;
            }
            
            .project-header {
                padding: 50px 0;
            }
            
            .project-image img {
                height: 300px;
            }
            
            .project-meta {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .project-links {
                flex-direction: column;
            }
            
            .project-link {
                justify-content: center;
            }
        }
    </style>
</head>
<body dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    
    <!-- Header -->
    <header class="project-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="project-title">{{ $project->title }}</h1>
                    <p class="lead mb-4">{{ $project->description }}</p>
                    
                    <div class="project-meta justify-content-center">
                        @if($project->created_at)
                            <div class="meta-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $project->created_at->format('F d, Y') }}</span>
                            </div>
                        @endif
                        
                        @if($project->github)
                            <div class="meta-item">
                                <i class="bi bi-github"></i>
                                <span>GitHub Available</span>
                            </div>
                        @endif
                        
                        @if($project->link)
                            <div class="meta-item">
                                <i class="bi bi-link-45deg"></i>
                                <span>Live Demo</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                
                <!-- Project Image -->
                @if($project->image)
                    <div class="project-image">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="img-fluid">
                    </div>
                @endif
                
                <!-- Video Demo -->
                @if($project->video)
                    <div class="video-container">
                        {!! $project->video !!}
                    </div>
                @endif
                
                <!-- Project Links -->
                @if($project->link || $project->github)
                    <div class="project-links">
                        @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" class="project-link live">
                                <i class="bi bi-play-circle"></i>
                                {{ __('messages.view_live_demo') }}
                            </a>
                        @endif
                        
                        @if($project->github)
                            <a href="{{ $project->github }}" target="_blank" class="project-link github">
                                <i class="bi bi-github"></i>
                                {{ __('messages.view_on_github') }}
                            </a>
                        @endif
                    </div>
                @endif
                
                <!-- Project Content -->
                <div class="project-content mt-5">
                    @if($project->content)
                        {!! $project->content !!}
                    @else
                        <p class="lead">{{ $project->description }}</p>
                    @endif
                </div>
                
                <!-- Back Button -->
                <div class="text-center mt-5">
                    <a href="{{ route('projects.index') }}" class="back-btn">
                        <i class="bi bi-arrow-left"></i>
                        {{ __('messages.back_to_projects') }}
                    </a>
                </div>
                
            </div>
        </div>
    </main>
    
    <!-- Related Projects -->
    @if($relatedProjects->count() > 0)
        <section class="related-projects">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="mb-3">{{ __('messages.related_projects') }}</h2>
                        <p class="text-muted">{{ __('messages.check_other_projects') }}</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    @foreach($relatedProjects as $relatedProject)
                        <div class="col-md-4">
                            <div class="related-project-card">
                                <a href="{{ route('projects.show', $relatedProject->slug) }}" class="text-decoration-none">
                                    <div class="related-project-img">
                                        @if($relatedProject->image)
                                            <img src="{{ asset('storage/' . $relatedProject->image) }}" alt="{{ $relatedProject->title }}">
                                        @else
                                            <img src="https://via.placeholder.com/400x300" alt="{{ $relatedProject->title }}">
                                        @endif
                                    </div>
                                    <div class="related-project-content">
                                        <h5 class="mb-2 text-dark">{{ $relatedProject->title }}</h5>
                                        <p class="text-muted mb-0">{{ Str::limit($relatedProject->description, 100) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    
    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.all_rights_reserved') }}</p>
                </div>
                <div class="col-md-6 text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none">
                        <i class="bi bi-house-door"></i> {{ __('messages.back_to_home') }}
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Add active class to current nav item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>