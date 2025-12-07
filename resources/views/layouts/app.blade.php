<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Omar Dev</title>

    <style>
        :root {
            --primary: #2563eb;
            --text: #1f2937;
            --bg: #ffffff;
            --nav-bg: rgba(255,255,255,0.75);
            --footer-bg: #f3f4f6;
        }

        .dark {
            --text: #e5e7eb;
            --bg: #0f172a;
            --nav-bg: rgba(15,23,42,0.75);
            --footer-bg: #1e293b;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "Tajawal", sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background .4s, color .4s;
        }

        /* NAVBAR */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--nav-bg);
            backdrop-filter: blur(12px);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd3;
            z-index: 100;
            transition: background .3s;
        }

        nav .logo {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
        }

        nav .logo span {
            color: var(--text);
        }

        nav ul {
            display: flex;
            gap: 25px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav a {
            text-decoration: none;
            color: var(--text);
            font-weight: 600;
            position: relative;
            transition: color .3s;
        }

        nav a:hover {
            color: var(--primary);
        }

        nav a::after {
            content: "";
            position: absolute;
            bottom: -4px;
            right: 0;
            width: 0%;
            height: 3px;
            background: var(--primary);
            transition: width .3s;
        }

        nav a:hover::after {
            width: 100%;
        }

        #toggleTheme {
            padding: 10px 12px;
            border-radius: 50%;
            cursor: pointer;
            border: none;
            background: #e5e7eb;
            font-size: 18px;
            transition: background .3s;
        }

        .dark #toggleTheme {
            background: #334155;
            color: white;
        }

        /* MAIN */
        main {
            padding-top: 140px;
            width: 90%;
            margin: auto;
            max-width: 1100px;
            min-height: 70vh;
            transition: color .3s;
        }

        /* FOOTER */
        footer {
            margin-top: 60px;
            padding: 20px 0;
            background: var(--footer-bg);
            text-align: center;
            color: var(--text);
            transition: background .4s;
            border-top: 1px solid #ddd3;
        }

        /* Animations */
        .fade-in, .slide-left, .slide-right {
            opacity: 0;
            transition: all .8s ease-out;
        }

        .fade-in.visible { opacity: 1; transform: translateY(0); }
        .slide-left.visible { opacity: 1; transform: translateX(0); }
        .slide-right.visible { opacity: 1; transform: translateX(0); }

        .slide-left { transform: translateX(-40px); }
        .slide-right { transform: translateX(40px); }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

<nav>
    <div class="logo">Omar.<span>Dev</span></div>

    <ul>
        <li><a href="#home">الرئيسية</a></li>
        <li><a href="#about">من أنا</a></li>
        <li><a href="#services">خدماتي</a></li>
        <li><a href="#portfolio">مشاريعي</a></li>
        <li><a href="#contact">تواصل معي</a></li>
    </ul>

    <button id="toggleTheme">🌙</button>
</nav>

<main>
    @yield('content')
</main>

<footer>
    &copy; 2025 عمر - جميع الحقوق محفوظة
</footer>

<script>
    const html = document.documentElement;
    const btn = document.getElementById("toggleTheme");

    // Toggle Theme
    btn.onclick = () => {
        html.classList.toggle("dark");
        btn.innerHTML = html.classList.contains("dark") ? "☀️" : "🌙";
    };

    // Scroll Animations
    const elements = document.querySelectorAll('.fade-in, .slide-left, .slide-right');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) entry.target.classList.add('visible');
        });
    }, { threshold: 0.2 });

    elements.forEach(el => observer.observe(el));
</script>

</body>
</html>
