@php
    $locale = app()->getLocale();
    $isAr = $locale === 'ar';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isAr ? 'rtl' : 'ltr' }}">
<head>
    <script>if(localStorage.getItem('theme')==='light')document.documentElement.classList.add('light');</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isAr ? $project->title : $project->title_en }} | {{ ($isAr ? $settings->site_name : $settings->site_name_en) ?? 'Omar' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/project-show.css') }}">
</head>
<body>
    <div class="bg-orbs"><div class="orb"></div><div class="orb"></div><div class="orb"></div></div>
    <div class="cursor-dot"></div>
    <div class="cursor-ring"></div>

    <!-- Navbar -->
    <nav class="navbar scrolled" id="main-nav">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-logo">OMAR.</a>
            <div class="nav-links">
                <a href="{{ route('home') }}"><i class="bi bi-house"></i> {{ $isAr ? 'الرئيسية' : 'Home' }}</a>
                <a href="{{ route('home') }}#projects">{{ $isAr ? 'أعمالي' : 'Projects' }}</a>
                <button class="theme-toggle" id="theme-toggle" title="تبديل الوضع"><i class="bi bi-moon-fill"></i></button>
                @if($isAr)
                    <a href="{{ route('language.switch', 'en') }}" class="lang-toggle">EN</a>
                @else
                    <a href="{{ route('language.switch', 'ar') }}" class="lang-toggle">AR</a>
                @endif
                <a href="https://wa.me/972567557774" target="_blank" class="nav-cta">{{ $isAr ? 'تواصل الآن' : 'Contact' }}</a>
            </div>
        </div>
    </nav>

    <!-- Hero Header -->
    <header class="project-hero">
        <div class="project-hero-inner">
            <div class="project-hero-content reveal">
                <nav class="breadcrumb-nav">
                    <a href="{{ route('home') }}">{{ $isAr ? 'الرئيسية' : 'Home' }}</a>
                    <i class="bi bi-chevron-{{ $isAr ? 'left' : 'right' }}"></i>
                    <span>{{ $isAr ? 'تفاصيل المشروع' : 'Project Details' }}</span>
                    <span class="views-badge"><i class="bi bi-eye-fill"></i> {{ $project->views_count ?? 0 }}</span>
                </nav>

                <h1 class="project-title">{{ $isAr ? $project->title : $project->title_en }}</h1>
                <p class="project-desc">{{ $isAr ? $project->description : $project->description_en }}</p>

                <!-- Rating Display -->
                <div class="rating-row">
                    <div>
                        <div id="rating-display" class="stars-display">
                            @php $avg = round($project->average_rating); @endphp
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $avg ? '-fill' : '' }}" style="color:{{ $i <= $avg ? '#fbbf24' : 'var(--star-empty)' }}"></i>
                            @endfor
                        </div>
                        <div class="rating-meta">
                            <span id="avg-val">{{ number_format($project->average_rating, 1) }}</span>/5
                            (<span id="count-val">{{ $project->ratings_count }}</span> {{ $isAr ? 'تقييم' : 'Ratings' }})
                        </div>
                    </div>
                    <div class="hero-divider"></div>
                    <div class="hero-actions">
                        @if($project->link)
                        <a href="{{ $project->link }}" target="_blank" class="btn-primary"><i class="bi bi-box-arrow-up-right"></i> {{ $isAr ? 'معاينة حية' : 'Live Demo' }}</a>
                        @endif
                        @if($project->github)
                        <a href="{{ $project->github }}" target="_blank" class="btn-outline"><i class="bi bi-github"></i> {{ $isAr ? 'الكود' : 'Source Code' }}</a>
                        @endif
                        @if($project->video)
                        <a href="#project-video" class="btn-outline"><i class="bi bi-play-circle-fill"></i> {{ $isAr ? 'فيديو المشروع' : 'Project Video' }}</a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Rating Card -->
            <div class="rating-card-wrap reveal reveal-delay-2">
                <div class="rating-card">
                    <div class="rating-card-glow"></div>
                    <h3>⭐ {{ $isAr ? 'قيّم هذا العمل' : 'Rate this work' }}</h3>
                    <div id="star-rating-input" class="star-input-row">
                        @for($i = 1; $i <= 5; $i++)
                        <button class="star-btn" data-rating="{{ $i }}"><i class="bi bi-star-fill"></i></button>
                        @endfor
                    </div>
                    <button id="submit-rating" class="submit-rating-btn">{{ $isAr ? 'إرسال التقييم' : 'Submit Rating' }}</button>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-row reveal">
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(14,165,233,0.1);color:var(--brand-light)"><i class="bi bi-calendar3"></i></div>
                <div>
                    <div class="stat-label">{{ $isAr ? 'تاريخ النشر' : 'Released' }}</div>
                    <div class="stat-val">{{ $project->created_at ? $project->created_at->format('M Y') : '2024' }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(6,182,212,0.1);color:var(--accent)"><i class="bi bi-stack"></i></div>
                <div>
                    <div class="stat-label">{{ $isAr ? 'التقنيات' : 'Technologies' }}</div>
                    <div class="tech-tags">
                        @php $techs = is_array($project->technologies) ? $project->technologies : (json_decode($project->technologies, true) ?: []); @endphp
                        @foreach(array_slice($techs, 0, 4) as $t)
                        <span class="tech-tag">{{ $t }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(14,165,233,0.1);color:var(--brand-light)"><i class="bi bi-award-fill"></i></div>
                <div>
                    <div class="stat-label">{{ $isAr ? 'نوع المشروع' : 'Project Type' }}</div>
                    <div class="stat-val">{{ $isAr ? 'تطبيق ويب متكامل' : 'Full-Stack Web App' }}</div>
                </div>
            </div>
        </div>
    </header>

    <!-- Video Section -->
    @if($project->video)
    <section id="project-video" class="video-section reveal">
        <div class="video-container">
            <span class="section-label">{{ $isAr ? 'عرض مرئي' : 'Video Presentation' }}</span>
            <h2 class="section-title">{{ $isAr ? 'شاهد المشروع' : 'Watch' }} <span class="grad-text">{{ $isAr ? 'بالفعل' : 'in Action' }}</span></h2>
            
            <div class="video-wrapper">
                @if(str_contains($project->video, 'youtube.com') || str_contains($project->video, 'youtu.be'))
                    @php
                        if(str_contains($project->video, 'v=')) {
                            $video_id = explode('v=', $project->video)[1];
                            $video_id = explode('&', $video_id)[0];
                        } else {
                            $video_id = basename($project->video);
                        }
                    @endphp
                    <iframe src="https://www.youtube.com/embed/{{ $video_id }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    <video controls>
                        <source src="{{ asset('storage/' . $project->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- Gallery Section -->
    <main class="gallery-section">
        <div class="gallery-header reveal">
            <span class="section-label">{{ $isAr ? 'معرض الصور' : 'Gallery' }}</span>
            <h2 class="section-title">{{ $isAr ? 'لقطات من' : 'Screenshots of' }} <span class="grad-text">{{ $isAr ? 'المشروع' : 'the Project' }}</span></h2>
        </div>
        <div class="gallery-cards reveal">
            @php $gallery = is_array($project->images) ? $project->images : (json_decode($project->images, true) ?: []); @endphp
            @foreach($gallery as $idx => $img)
            <div class="gallery-card" data-index="{{ $idx }}">
                <div class="gallery-card-inner">
                    <img src="{{ asset('storage/' . $img) }}" alt="Project Screenshot {{ $idx + 1 }}" loading="lazy">
                    <div class="gallery-card-overlay">
                        <div class="gallery-card-number">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="gallery-card-actions">
                            <button class="gallery-zoom-btn" data-index="{{ $idx }}"><i class="bi bi-arrows-fullscreen"></i></button>
                        </div>
                    </div>
                    <div class="gallery-card-shine"></div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <div class="lightbox-backdrop"></div>
        <button class="lightbox-close"><i class="bi bi-x-lg"></i></button>
        <button class="lightbox-nav lightbox-prev"><i class="bi bi-chevron-{{ $isAr ? 'right' : 'left' }}"></i></button>
        <button class="lightbox-nav lightbox-next"><i class="bi bi-chevron-{{ $isAr ? 'left' : 'right' }}"></i></button>
        <div class="lightbox-content">
            <img id="lightbox-img" src="" alt="">
            <div class="lightbox-counter"><span id="lightbox-current">1</span> / <span id="lightbox-total">{{ count($gallery) }}</span></div>
        </div>
    </div>

    <footer class="footer">
        <div>&copy; {{ date('Y') }} {{ $isAr ? 'جميع الحقوق محفوظة' : 'All rights reserved' }} - {{ ($isAr ? $settings->site_name : $settings->site_name_en) }}.</div>
    </footer>

    <script src="{{ asset('js/portfolio.js') }}"></script>
    <script>
        // Theme Toggle
        const themeBtn = document.getElementById('theme-toggle');
        const themeIcon = themeBtn.querySelector('i');
        function updateThemeIcon() {
            const isLight = document.documentElement.classList.contains('light');
            themeIcon.className = isLight ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
        }
        updateThemeIcon();
        themeBtn.addEventListener('click', () => {
            document.documentElement.classList.toggle('light');
            localStorage.setItem('theme', document.documentElement.classList.contains('light') ? 'light' : 'dark');
            updateThemeIcon();
        });

        // Rating Logic
        let selectedRating = 0;
        const starBtns = document.querySelectorAll('.star-btn');
        starBtns.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                const r = this.dataset.rating;
                starBtns.forEach(b => {
                    b.classList.toggle('preview', b.dataset.rating <= r);
                });
            });
            btn.addEventListener('click', function() {
                selectedRating = this.dataset.rating;
                starBtns.forEach(b => {
                    b.classList.toggle('selected', b.dataset.rating <= selectedRating);
                    b.classList.remove('preview');
                });
            });
        });
        document.getElementById('star-rating-input').addEventListener('mouseleave', () => {
            starBtns.forEach(b => {
                b.classList.remove('preview');
                b.classList.toggle('selected', b.dataset.rating <= selectedRating);
            });
        });
        document.getElementById('submit-rating').addEventListener('click', async function() {
            if (!selectedRating) return;
            const res = await fetch('{{ route("project.rate", $project->slug) }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ rating: selectedRating })
            });
            const data = await res.json();
            if (data.success) { alert(data.message); location.reload(); }
            else { alert(data.message); }
        });

        // Lightbox
        const lightbox = document.getElementById('lightbox');
        const lbImg = document.getElementById('lightbox-img');
        const lbCurrent = document.getElementById('lightbox-current');
        const images = @json($gallery);
        let currentIdx = 0;

        function openLightbox(idx) {
            currentIdx = idx;
            lbImg.src = '{{ asset("storage") }}/' + images[idx];
            lbCurrent.textContent = idx + 1;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }
        function navLightbox(dir) {
            currentIdx = (currentIdx + dir + images.length) % images.length;
            lbImg.style.opacity = '0';
            lbImg.style.transform = 'scale(0.95)';
            setTimeout(() => {
                lbImg.src = '{{ asset("storage") }}/' + images[currentIdx];
                lbCurrent.textContent = currentIdx + 1;
                lbImg.style.opacity = '1';
                lbImg.style.transform = 'scale(1)';
            }, 200);
        }

        document.querySelectorAll('.gallery-card').forEach(card => {
            card.addEventListener('click', () => openLightbox(parseInt(card.dataset.index)));
        });
        document.querySelector('.lightbox-close').addEventListener('click', closeLightbox);
        document.querySelector('.lightbox-backdrop').addEventListener('click', closeLightbox);
        document.querySelector('.lightbox-prev').addEventListener('click', () => navLightbox(-1));
        document.querySelector('.lightbox-next').addEventListener('click', () => navLightbox(1));
        document.addEventListener('keydown', e => {
            if (!lightbox.classList.contains('active')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') navLightbox({{ $isAr ? '1' : '-1' }});
            if (e.key === 'ArrowRight') navLightbox({{ $isAr ? '-1' : '1' }});
        });

        // 3D Tilt on gallery cards
        document.querySelectorAll('.gallery-card').forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                card.querySelector('.gallery-card-inner').style.transform =
                    `perspective(800px) rotateY(${x * 8}deg) rotateX(${-y * 8}deg) scale(1.02)`;
                const shine = card.querySelector('.gallery-card-shine');
                shine.style.background = `radial-gradient(circle at ${(x+0.5)*100}% ${(y+0.5)*100}%, rgba(255,255,255,0.15), transparent 60%)`;
            });
            card.addEventListener('mouseleave', e => {
                card.querySelector('.gallery-card-inner').style.transform = '';
                card.querySelector('.gallery-card-shine').style.background = '';
            });
        });
    </script>
</body>
</html>