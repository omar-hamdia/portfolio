document.addEventListener('DOMContentLoaded', () => {

    // ===== PRELOADER =====
    const preloader = document.getElementById('preloader');
    const hidePreloader = () => { if(preloader) preloader.classList.add('done'); };
    window.addEventListener('load', hidePreloader);
    setTimeout(hidePreloader, 3000);

    // ===== CUSTOM CURSOR =====
    const dot = document.querySelector('.cursor-dot');
    const ring = document.querySelector('.cursor-ring');
    if(dot && ring) {
        let mouseX = 0, mouseY = 0, ringX = 0, ringY = 0;
        document.addEventListener('mousemove', e => {
            mouseX = e.clientX; mouseY = e.clientY;
            dot.style.left = mouseX - 4 + 'px';
            dot.style.top = mouseY - 4 + 'px';
        });
        const animateRing = () => {
            ringX += (mouseX - ringX) * 0.15;
            ringY += (mouseY - ringY) * 0.15;
            ring.style.left = ringX - 20 + 'px';
            ring.style.top = ringY - 20 + 'px';
            requestAnimationFrame(animateRing);
        };
        animateRing();
        document.querySelectorAll('a, button, .project-card, .skill-tag, .service-card').forEach(el => {
            el.addEventListener('mouseenter', () => { ring.classList.add('hover'); dot.style.transform = 'scale(0.5)'; });
            el.addEventListener('mouseleave', () => { ring.classList.remove('hover'); dot.style.transform = 'scale(1)'; });
        });
    }

    // ===== NAVBAR SCROLL =====
    const navbar = document.getElementById('main-nav');
    window.addEventListener('scroll', () => {
        if(navbar) navbar.classList.toggle('scrolled', window.scrollY > 80);
    });

    // ===== SCROLL REVEAL =====
    const reveals = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    reveals.forEach(el => revealObserver.observe(el));

    // ===== COUNTER ANIMATION =====
    const counters = document.querySelectorAll('[data-count]');
    const countObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.count);
                let current = 0;
                const step = Math.max(1, Math.floor(target / 60));
                const timer = setInterval(() => {
                    current += step;
                    if(current >= target) { current = target; clearInterval(timer); }
                    el.textContent = current + (el.dataset.suffix || '');
                }, 30);
                countObserver.unobserve(el);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(el => countObserver.observe(el));

    // ===== TILT EFFECT ON PROJECT CARDS =====
    document.querySelectorAll('.project-card').forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-6px)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });

    // ===== MAGNETIC BUTTONS =====
    document.querySelectorAll('.btn-primary, .nav-cta').forEach(btn => {
        btn.addEventListener('mousemove', e => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            btn.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0, 0)';
        });
    });

    // ===== TEXT SCRAMBLE FOR HERO =====
    class TextScramble {
        constructor(el) {
            this.el = el;
            this.chars = '!<>-_\\/[]{}—=+*^?#________';
            this.update = this.update.bind(this);
        }
        setText(newText) {
            const oldText = this.el.innerText;
            const length = Math.max(oldText.length, newText.length);
            const promise = new Promise(resolve => this.resolve = resolve);
            this.queue = [];
            for(let i = 0; i < length; i++) {
                const from = oldText[i] || '';
                const to = newText[i] || '';
                const start = Math.floor(Math.random() * 40);
                const end = start + Math.floor(Math.random() * 40);
                this.queue.push({ from, to, start, end });
            }
            cancelAnimationFrame(this.frameRequest);
            this.frame = 0;
            this.update();
            return promise;
        }
        update() {
            let output = '';
            let complete = 0;
            for(let i = 0, n = this.queue.length; i < n; i++) {
                let { from, to, start, end, char } = this.queue[i];
                if(this.frame >= end) {
                    complete++;
                    output += to;
                } else if(this.frame >= start) {
                    if(!char || Math.random() < 0.28) {
                        char = this.chars[Math.floor(Math.random() * this.chars.length)];
                        this.queue[i].char = char;
                    }
                    output += `<span class="grad-text">${char}</span>`;
                } else {
                    output += from;
                }
            }
            this.el.innerHTML = output;
            if(complete === this.queue.length) {
                this.resolve();
            } else {
                this.frameRequest = requestAnimationFrame(this.update);
                this.frame++;
            }
        }
    }

    const scrambleEl = document.getElementById('scramble-text');
    if(scrambleEl) {
        const phrases = JSON.parse(scrambleEl.dataset.phrases || '["مطور ويب"]');
        const fx = new TextScramble(scrambleEl);
        let counter = 0;
        const next = () => {
            fx.setText(phrases[counter]).then(() => setTimeout(next, 2500));
            counter = (counter + 1) % phrases.length;
        };
        next();
    }

    // ===== SWIPER INIT =====
    if(typeof Swiper !== 'undefined') {
        new Swiper('.testimonialSwiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            pagination: { el: '.swiper-pagination', clickable: true },
            breakpoints: { 768: { slidesPerView: 2 } },
            autoplay: { delay: 4500 }
        });
    }

    // ===== PARALLAX ON MOUSE =====
    document.addEventListener('mousemove', e => {
        const orbs = document.querySelectorAll('.bg-orbs .orb');
        const x = (e.clientX / window.innerWidth - 0.5) * 2;
        const y = (e.clientY / window.innerHeight - 0.5) * 2;
        orbs.forEach((orb, i) => {
            const speed = (i + 1) * 8;
            orb.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
        });
    });

    // ===== SMOOTH SCROLL & MOBILE MENU CLOSE =====
    document.querySelectorAll('.nav-links a, a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const href = a.getAttribute('href');
            if(href && href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if(target) {
                    // Close mobile menu if open
                    const navLinks = document.querySelector('.nav-links');
                    if(navLinks) navLinks.classList.remove('show');
                    
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });

    // ===== BACK TO TOP LOGIC =====
    const backToTop = document.getElementById('back-to-top');
    if(backToTop) {
        window.addEventListener('scroll', () => {
            backToTop.classList.toggle('visible', window.scrollY > 500);
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ===== ACTIVE SECTION HIGHLIGHT FOR MOBILE MENU =====
    window.addEventListener('scroll', () => {
        let current = "";
        const sections = document.querySelectorAll("section");
        const navLinks = document.querySelectorAll(".nav-links a");
        
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            if (pageYOffset >= sectionTop - 150) {
                current = section.getAttribute("id");
            }
        });

        navLinks.forEach((a) => {
            a.classList.remove("active");
            if (a.getAttribute("href") === `#${current}`) {
                a.classList.add("active");
            }
        });
    });

});
