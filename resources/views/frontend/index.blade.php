@php
    $locale = app()->getLocale();
    $isAr = $locale === 'ar';
    
    // تحسين جلب الصورة مع ضمان الرجوع للصورة الأساسية في حال عدم وجود صورة إنجليزية
    $profileImg = asset('assets/img/profile-img.jpg');
    if(isset($about)) {
        if($isAr) {
            $profileImg = $about->image ? asset('storage/' . $about->image) : $profileImg;
        } else {
            $profileImg = $about->image_en ? asset('storage/' . $about->image_en) : ($about->image ? asset('storage/' . $about->image) : $profileImg);
        }
    }
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isAr ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($isAr ? $settings->site_name : $settings->site_name_en) ?? 'عمر حمدية | OMAR' }}</title>
    <meta name="description" content="{{ ($isAr ? $about->title : $about->title_en) ?? 'Portfolio' }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">

    <script>
        if (localStorage.getItem('theme') === 'light') document.documentElement.classList.add('light');
    </script>
    <style>
        /* Side Navigation */
        .side-nav {
            position: fixed;
            top: 50%;
            {{ $isAr ? 'right: 2rem' : 'left: 2rem' }};
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            z-index: 1000;
        }
        .side-nav-item {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--bg2);
            border: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 1.2rem;
            transition: all 0.3s;
            text-decoration: none;
            position: relative;
        }
        .side-nav-item:hover, .side-nav-item.active {
            background: var(--brand);
            color: #fff;
            border-color: var(--brand);
            box-shadow: 0 0 15px var(--glow);
        }
        .side-nav-item::after {
            content: attr(data-label);
            position: absolute;
            {{ $isAr ? 'right: 120%' : 'left: 120%' }};
            background: var(--brand);
            color: #fff;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }
        .side-nav-item:hover::after {
            opacity: 1;
            visibility: visible;
            {{ $isAr ? 'right: 140%' : 'left: 140%' }};
        }

        /* About Section New Design */
        .about-modern {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 4rem;
            align-items: center;
        }
        .about-visual {
            position: relative;
        }
        .about-visual img {
            width: 100%;
            border-radius: 2rem;
            border: 1px solid var(--card-border);
            filter: grayscale(0.5);
            transition: all 0.5s;
        }
        .about-visual:hover img {
            filter: grayscale(0);
            transform: scale(1.02);
        }
        .about-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .stat-item {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            padding: 1.5rem;
            border-radius: 1.5rem;
            text-align: center;
        }
        .stat-item h4 { font-size: 2rem; font-weight: 900; color: var(--brand); margin-bottom: 0.2rem; }
        .stat-item p { font-size: 0.85rem; color: var(--text-muted); font-weight: 700; }

        @media (max-width: 991px) {
            .about-modern { grid-template-columns: 1fr; gap: 3rem; }
            .side-nav { display: none; }
        }

        /* Light mode visibility fixes */
        html.light .about-content p, 
        html.light .service-card p, 
        html.light .hero-desc,
        html.light .testimonial-card .tc-msg,
        html.light .contact-form label {
            color: #475569;
        }
        html.light .skill-tag {
            background: #f1f5f9;
            color: #0f172a;
        }
        html.light .contact-form input, html.light .contact-form textarea {
            background: #fff;
            color: #0f172a;
            border-color: rgba(0,0,0,0.1);
        }

        /* Social Icons Styling */
        .social-bar { display: flex; gap: 1rem; margin-top: 2rem; }
        .social-link {
            width: 45px; height: 45px; border-radius: 12px;
            background: var(--card-bg); border: 1px solid var(--card-border);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-muted); font-size: 1.2rem;
            transition: all 0.3s; text-decoration: none;
        }
        .social-link:hover {
            background: var(--brand); color: #fff;
            border-color: var(--brand); transform: translateY(-5px);
            box-shadow: 0 10px 20px var(--glow);
        }
    </style>
</head>
<body>

    <!-- BG Orbs -->
    <div class="bg-orbs"><div class="orb"></div><div class="orb"></div><div class="orb"></div></div>

    <!-- Custom Cursor -->
    <div class="cursor-dot"></div>
    <div class="cursor-ring"></div>

    <!-- Preloader -->
    <div id="preloader"><span class="loader-logo">OMAR.</span></div>

    <!-- Side Nav -->
    <div class="side-nav">
        <a href="#home" class="side-nav-item active" data-label="{{ $isAr ? 'الرئيسية' : 'Home' }}"><i class="bi bi-house-door"></i></a>
        <a href="#about" class="side-nav-item" data-label="{{ $isAr ? 'من أنا' : 'About' }}"><i class="bi bi-person"></i></a>
        <a href="#services" class="side-nav-item" data-label="{{ $isAr ? 'خدماتي' : 'Services' }}"><i class="bi bi-grid"></i></a>
        <a href="#projects" class="side-nav-item" data-label="{{ $isAr ? 'أعمالي' : 'Projects' }}"><i class="bi bi-folder2-open"></i></a>
        <a href="#testimonials" class="side-nav-item" data-label="{{ $isAr ? 'العملاء' : 'Testimonials' }}"><i class="bi bi-chat-left-dots"></i></a>
        <a href="#contact" class="side-nav-item" data-label="{{ $isAr ? 'اتصل بي' : 'Contact' }}"><i class="bi bi-envelope"></i></a>
    </div>

    <!-- Navbar -->
    <nav class="navbar" id="main-nav">
        <div class="nav-inner">
            <a href="#" class="nav-logo">OMAR.</a>
            <div class="nav-links">
                <div class="mobile-close" onclick="document.querySelector('.nav-links').classList.remove('show')">
                    <i class="bi bi-x-lg"></i>
                </div>
                <a href="#home">{{ $isAr ? 'الرئيسية' : 'Home' }}</a>
                <a href="#about">{{ $isAr ? 'من أنا' : 'About' }}</a>
                <a href="#services">{{ $isAr ? 'خدماتي' : 'Services' }}</a>
                <a href="#projects">{{ $isAr ? 'أعمالي' : 'Projects' }}</a>
                <a href="#testimonials">{{ $isAr ? 'العملاء' : 'Clients' }}</a>

                <!-- Theme Toggle -->
                <button class="theme-toggle" id="theme-toggle" title="تبديل الوضع">
                    <i class="bi bi-moon-fill"></i>
                </button>

                <!-- Language Toggle -->
                @if($isAr)
                    <a href="{{ route('language.switch', 'en') }}" class="lang-toggle">EN</a>
                @else
                    <a href="{{ route('language.switch', 'ar') }}" class="lang-toggle">AR</a>
                @endif

                <a href="https://wa.me/972567557774" target="_blank" class="nav-cta">
                    <i class="bi bi-whatsapp"></i> {{ $isAr ? 'تواصل معي' : 'Contact Me' }}
                </a>
            </div>
        </div>
    </nav>

    <!-- ==================== HERO ==================== -->
    <section class="hero" id="home">
        <div class="hero-grid">
            <div>
                <div class="hero-badge reveal">
                    <span class="dot"></span>
                    {{ $isAr ? 'متاح للعمل الآن' : 'Available for work' }}
                </div>
                <h1 class="hero-title reveal reveal-delay-1">
                    {{ $isAr ? 'أنا' : 'I am' }} <span class="grad-text">{{ ($isAr ? $settings->site_name : ($settings->site_name_en ?: 'Omar Hamdia')) }}</span><br>
                    <span id="scramble-text" data-phrases='{{ $isAr ? "[\"مطور لارافيل ⚡\",\"مبرمج Full Stack 🚀\",\"مطور تطبيقات ويب 💻\"]" : "[\"Laravel Developer ⚡\",\"Full Stack Engineer 🚀\",\"Web Application Dev 💻\"]" }}' style="min-height:1.2em;display:inline-block">Laravel Developer ⚡</span>
                </h1>
                <p class="hero-desc reveal reveal-delay-2">
                    {{ ($isAr ? $about->title : $about->title_en) ?? 'Crafting digital experiences.' }}
                </p>
                <div class="hero-btns reveal reveal-delay-3">
                    <a href="#projects" class="btn-primary">{{ $isAr ? 'استكشف أعمالي' : 'Explore My Work' }}</a>
                    <a href="https://wa.me/972567557774" target="_blank" class="btn-outline">
                        <i class="bi bi-whatsapp"></i> {{ $isAr ? 'دعنا نتحدث' : 'Let\'s Talk' }}
                    </a>
                </div>

                <!-- Social Bar Hero -->
                <div class="social-bar reveal reveal-delay-4">
                    @php
                        $socialIcons = [
                            'facebook' => 'bi-facebook',
                            'twitter' => 'bi-twitter-x',
                            'instagram' => 'bi-instagram',
                            'linkedin' => 'bi-linkedin',
                            'github' => 'bi-github',
                            'youtube' => 'bi-youtube'
                        ];
                    @endphp
                    @foreach($settings->social_links as $platform => $url)
                        @if($url)
                        <a href="{{ $url }}" target="_blank" class="social-link" title="{{ ucfirst($platform) }}">
                            <i class="bi {{ $socialIcons[$platform] ?? 'bi-link-45deg' }}"></i>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="hero-visual reveal">
                <div class="hero-img-wrap">
                    <img src="{{ $profileImg }}" alt="Omar">
                </div>
                <!-- Float Cards -->
                <div class="float-card" style="top:10%;left:-10%">
                    <div class="fc-icon" style="background:rgba(14,165,233,0.2);color:#38bdf8"><i class="bi bi-code-slash"></i></div>
                    Laravel & PHP
                </div>
                <div class="float-card" style="bottom:15%;right:-5%">
                    <div class="fc-icon" style="background:rgba(6,182,212,0.2);color:#06b6d4"><i class="bi bi-database-fill"></i></div>
                    Full Stack Dev
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== ABOUT MODERN ==================== -->
    <section class="section" id="about">
        <div class="about-modern">
            <div class="about-visual reveal">
                <img src="{{ $profileImg }}" alt="Omar">
                <div class="about-stats">
                    <div class="stat-item">
                        <h4 data-count="1">0</h4>
                        <p>{{ $isAr ? 'سنة خبرة' : 'Year Experience' }}</p>
                    </div>
                    <div class="stat-item">
                        <h4 data-count="{{ $projects->count() }}">0</h4>
                        <p>{{ $isAr ? 'مشروع منجز' : 'Projects Done' }}</p>
                    </div>
                </div>
            </div>
            <div class="about-content">
                <span class="section-label reveal">{{ $isAr ? 'من أنا' : 'About Me' }}</span>
                <h2 class="section-title reveal reveal-delay-1" style="{{ $isAr ? 'text-align:right' : 'text-align:left' }};margin-bottom:2rem">
                    {{ $isAr ? 'شغف في البرمجة' : 'Passion for Coding' }}<br><span class="grad-text">{{ $isAr ? 'وإبداع في التنفيذ' : 'Creative Implementation' }}</span>
                </h2>
                <div class="reveal reveal-delay-2 about-text-content" style="color:var(--text-muted);line-height:2;font-size:1.1rem;margin-bottom:2rem">
                    {!! ($isAr ? $about->content : $about->content_en) ?? 'Content goes here.' !!}
                </div>
                
                <div class="skills-box reveal reveal-delay-3">
                    <h4 style="color:var(--heading);font-weight:800;margin-bottom:1rem;display:flex;align-items:center;gap:0.75rem">
                        <i class="bi bi-stack text-brand"></i> {{ $isAr ? 'التقنيات التي أتقنها' : 'Tech Stack' }}
                    </h4>
                    <div style="display:flex;flex-wrap:wrap;gap:0.5rem">
                        @php 
                            $defaultSkills = [
                                'PHP', 'Laravel', 'HTML', 'CSS', 
                                'JavaScript', 'Python', 'MySQL'
                            ];
                            $skills = is_array($about->skills ?? []) ? ($about->skills ?? []) : (json_decode($about->skills ?? '[]', true) ?: $defaultSkills); 
                        @endphp
                        @foreach($skills as $skill)
                            <span class="skill-tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>

                @if($about->cv)
                <a href="{{ asset('storage/' . $about->cv) }}" target="_blank" class="btn-primary reveal reveal-delay-4" style="margin-top:2.5rem;display:inline-flex;align-items:center;gap:0.75rem">
                    <i class="bi bi-download"></i> {{ $isAr ? 'تحميل السيرة الذاتية' : 'Download CV' }}
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ==================== SERVICES ==================== -->
    <section class="section" id="services" style="background:var(--bg2)">
        <div class="section-header">
            <span class="section-label reveal">{{ $isAr ? 'خدماتي' : 'My Services' }}</span>
            <h2 class="section-title reveal reveal-delay-1">{{ $isAr ? 'حلول برمجية' : 'Digital' }} <span class="grad-text">{{ $isAr ? 'مخصصة' : 'Solutions' }}</span></h2>
        </div>
        <div class="services-grid">
            @foreach($services as $i => $service)
            <div class="service-card reveal reveal-delay-{{ ($i % 3) + 1 }}">
                <div class="sc-icon">
                    @if($service->icon)
                        <img src="{{ asset('storage/' . $service->icon) }}" alt="icon">
                    @else
                        <i class="bi bi-lightning-fill" style="font-size:1.5rem;color:var(--brand-light)"></i>
                    @endif
                </div>
                <h3>{{ $isAr ? $service->title : $service->title_en }}</h3>
                <p>{{ $isAr ? $service->description : $service->description_en }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ==================== PROJECTS ==================== -->
    <section class="section" id="projects">
        <div class="section-header">
            <span class="section-label reveal">{{ $isAr ? 'أعمالي' : 'Portfolio' }}</span>
            <h2 class="section-title reveal reveal-delay-1">{{ $isAr ? 'أحدث' : 'Featured' }} <span class="grad-text">{{ $isAr ? 'المشاريع' : 'Projects' }}</span></h2>
        </div>
        <div class="projects-bento">
            @foreach($projects as $i => $project)
            <div class="project-card reveal reveal-delay-{{ ($i % 3) + 1 }}">
                <img src="{{ asset('storage/' . $project->image) }}" alt="project">
                <div class="project-overlay">
                    <div class="po-rating">
                        <i class="bi bi-star-fill"></i> {{ number_format($project->average_rating, 1) }}
                    </div>
                    <div class="po-rating" style="{{ $isAr ? 'left:1.25rem;right:auto' : 'right:1.25rem;left:auto' }};color:var(--text)">
                        <i class="bi bi-eye-fill text-brand"></i> {{ $project->views_count ?? 0 }}
                    </div>
                    <h3>{{ $isAr ? $project->title : $project->title_en }}</h3>
                    <a href="{{ route('projects.show', $project->slug) }}" class="po-link">
                        {{ $isAr ? 'عرض التفاصيل' : 'View Details' }} <i class="bi bi-arrow-{{ $isAr ? 'left' : 'right' }}"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ==================== TESTIMONIALS ==================== -->
    <section class="section" id="testimonials" style="background:var(--bg2)">
        <div class="section-header">
            <span class="section-label reveal">{{ $isAr ? 'آراء العملاء' : 'Testimonials' }}</span>
            <h2 class="section-title reveal reveal-delay-1">{{ $isAr ? 'ماذا يقول' : 'Client' }} <span class="grad-text">{{ $isAr ? 'العملاء' : 'Feedback' }}</span></h2>
        </div>
        <div class="testimonials-track">
            <div class="swiper testimonialSwiper">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $t)
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <p class="tc-msg">"{{ $t->message }}"</p>
                            <div class="tc-author">
                                <div class="tc-avatar">{{ mb_substr($t->name, 0, 1) }}</div>
                                <div>
                                    <div class="tc-name">{{ $t->name }}</div>
                                    <div class="tc-role">{{ $t->role }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- ==================== CONTACT ==================== -->
    <section class="section" id="contact">
        <div class="section-header">
            <span class="section-label reveal">{{ $isAr ? 'تواصل معي' : 'Contact Me' }}</span>
            <h2 class="section-title reveal reveal-delay-1">{{ $isAr ? 'لنبدأ العمل' : 'Let\'s' }} <span class="grad-text">{{ $isAr ? 'سوياً' : 'Work Together' }}</span></h2>
        </div>
        <div style="max-width:800px;margin:0 auto" class="reveal reveal-delay-2">
            <div class="contact-form" style="padding:3rem;background:var(--bg2);border-radius:2rem;border:1px solid var(--card-border)">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem">
                        <div>
                            <label style="display:block;margin-bottom:0.5rem;font-weight:700">{{ $isAr ? 'الاسم الكامل' : 'Full Name' }}</label>
                            <input type="text" name="name" required style="width:100%;padding:0.85rem 1.25rem;border-radius:0.75rem;background:rgba(255,255,255,0.03);border:1px solid var(--card-border);color:var(--text);outline:none">
                        </div>
                        <div>
                            <label style="display:block;margin-bottom:0.5rem;font-weight:700">{{ $isAr ? 'البريد الإلكتروني' : 'Email Address' }}</label>
                            <input type="email" name="email" required style="width:100%;padding:0.85rem 1.25rem;border-radius:0.75rem;background:rgba(255,255,255,0.03);border:1px solid var(--card-border);color:var(--text);outline:none">
                        </div>
                    </div>
                    <div style="margin-bottom:1.5rem">
                        <label style="display:block;margin-bottom:0.5rem;font-weight:700">{{ $isAr ? 'الموضوع' : 'Subject' }}</label>
                        <input type="text" name="subject" required style="width:100%;padding:0.85rem 1.25rem;border-radius:0.75rem;background:rgba(255,255,255,0.03);border:1px solid var(--card-border);color:var(--text);outline:none">
                    </div>
                    <div style="margin-bottom:2rem">
                        <label style="display:block;margin-bottom:0.5rem;font-weight:700">{{ $isAr ? 'الرسالة' : 'Your Message' }}</label>
                        <textarea name="message" rows="5" required style="width:100%;padding:0.85rem 1.25rem;border-radius:0.75rem;background:rgba(255,255,255,0.03);border:1px solid var(--card-border);color:var(--text);outline:none;resize:none"></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width:100%;font-size:1.1rem">
                        {{ $isAr ? 'إرسال الرسالة' : 'Send Message' }} <i class="bi bi-send-fill" style="margin-{{ $isAr ? 'right' : 'left' }}:0.5rem"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="nav-logo" style="margin-bottom:1rem;display:inline-block">OMAR.</div>
        
        <div style="display:flex;justify-content:center;gap:1rem;margin-bottom:1.5rem">
            @foreach($settings->social_links as $platform => $url)
                @if($url)
                <a href="{{ $url }}" target="_blank" style="color:var(--text-muted);font-size:1.4rem;transition:0.3s" onmouseover="this.style.color='var(--brand)'" onmouseout="this.style.color='var(--text-muted)'">
                    <i class="bi {{ $socialIcons[$platform] ?? 'bi-link-45deg' }}"></i>
                </a>
                @endif
            @endforeach
        </div>

        <div>&copy; {{ date('Y') }} {{ ($isAr ? $settings->site_name : $settings->site_name_en) }}. All rights reserved.</div>
    </footer>

    <!-- Back to Top -->
    <div class="back-to-top" id="back-to-top">
        <i class="bi bi-arrow-up-short"></i>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
            const isLight = document.documentElement.classList.contains('light');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
            updateThemeIcon();
        });

        // Scroll active nav
        window.addEventListener('scroll', () => {
            let current = "";
            const sections = document.querySelectorAll("section");
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 100) {
                    current = section.getAttribute("id");
                }
            });

            document.querySelectorAll(".side-nav-item").forEach((li) => {
                li.classList.remove("active");
                if (li.getAttribute("href").includes(current)) {
                    li.classList.add("active");
                }
            });
        });
    </script>
</body>
</html>