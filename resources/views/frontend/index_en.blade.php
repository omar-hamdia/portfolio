<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ $settings->site_name ?? __('messages.site_name') }}</title>
  <meta content="{{ $settings->meta_description ?? __('messages.site_description') }}" name="description">
  <meta content="{{ $settings->meta_keywords ?? 'web development, laravel, portfolio' }}" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- For Arabic support -->
  @if(app()->getLocale() == 'ar')
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/css/portfolio-fix.css') }}" rel="stylesheet">
<style>
    /* احتفظ فقط بالتنسيقات الأساسية اللازمة هنا */
    
    /* ===== Language Switcher ===== */
    .language-switcher {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1000;
      display: flex;
      gap: 8px;
    }
    
    /* ... باقي تنسيقات اللغة والـ RTL فقط ... */
    
    /* ===== About Section Only ===== */
    .about {
        padding: 80px 0;
        background-color: #f9f9f9;
    }
    
    /* ... باقي تنسيقات About فقط ... */
    
    /* ===== IMPORTANT: Reset conflicting styles ===== */
    #portfolio {
        all: initial;
        display: block !important;
        position: relative !important;
    }
    
    #portfolio * {
        box-sizing: border-box !important;
    }
    
    /* إزالة أي تنسيقات متعارضة */
    body .portfolio,
    body .portfolio * {
        all: unset;
        box-sizing: border-box;
    }
    
    /* تأكد من ظهور العناصر */
    .portfolio-grid,
    .portfolio-card,
    .card-image,
    .card-image img {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
  </style>
  @endif

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <style>
    /* ===== Language Switcher as Flag Icons ===== */
    .language-switcher {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1000;
      display: flex;
      gap: 8px;
    }

    [dir="rtl"] .language-switcher {
      right: auto;
      left: 20px;
    }

    .lang-btn {
      background: rgba(255, 255, 255, 0.9);
      color: white;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      border: 3px solid rgba(255, 255, 255, 0.8);
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .lang-btn:hover {
      transform: translateY(-3px) scale(1.1);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
      border-color: #007bff;
    }

    .lang-btn.active {
      border-color: #007bff;
      transform: scale(1.1);
      box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }

    .flag-icon {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      font-weight: bold;
    }

    .lang-btn:hover .flag-icon {
      transform: scale(1.1);
    }

    /* Tooltip for language buttons */
    .lang-tooltip {
      position: absolute;
      background: rgba(0, 0, 0, 0.8);
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
      white-space: nowrap;
      top: 100%;
      left: 50%;
      transform: translateX(-50%);
      margin-top: 10px;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      z-index: 1001;
    }

    .lang-btn:hover .lang-tooltip {
      opacity: 1;
      visibility: visible;
      margin-top: 8px;
    }

    /* Language indicator dot */
    .lang-indicator {
      position: absolute;
      bottom: 2px;
      right: 2px;
      width: 10px;
      height: 10px;
      background: #007bff;
      border-radius: 50%;
      border: 2px solid white;
      display: none;
    }

    .lang-btn.active .lang-indicator {
      display: block;
    }

    /* RTL Support */
    [dir="rtl"] .navmenu ul {
      padding-right: 0;
    }

    [dir="rtl"] .bi-chevron-right::before {
      transform: rotate(180deg);
    }

    [dir="rtl"] .text-start {
      text-align: right !important;
    }

    [dir="rtl"] .text-end {
      text-align: left !important;
    }

    [dir="rtl"] .me-auto {
      margin-left: auto !important;
      margin-right: 0 !important;
    }

    [dir="rtl"] .ms-auto {
      margin-right: auto !important;
      margin-left: 0 !important;
    }

    [dir="rtl"] .ms-1 {
      margin-right: 0.25rem !important;
      margin-left: 0 !important;
    }

    [dir="rtl"] .me-1 {
      margin-left: 0.25rem !important;
      margin-right: 0 !important;
    }

    [dir="rtl"] .pe-0 {
      padding-left: 0 !important;
      padding-right: 0 !important;
    }

    [dir="rtl"] .ps-0 {
      padding-right: 0 !important;
      padding-left: 0 !important;
    }

    /* ===== About Section Styles ===== */
    .about {
        padding: 80px 0;
        background-color: #f9f9f9;
    }

    .about .section-title h2 {
        font-size: 36px;
        font-weight: 700;
        color: #333;
        text-align: center;
        margin-bottom: 10px;
    }

    .about .section-title p {
        font-size: 16px;
        color: #777;
        text-align: center;
        margin-bottom: 40px;
    }

    .about .content {
        font-size: 16px;
        line-height: 1.8;
        color: #555;
    }

    .about .content p {
        margin-bottom: 20px;
    }

    .about .content strong {
        color: #0d6efd;
    }

    .about img {
        border-radius: 12px;
        border: 3px solid #0d6efd;
        max-width: 100%;
        height: auto;
        object-fit: cover;
        transition: transform 0.3s ease;
        filter: brightness(1.05) contrast(1.1);
    }

    .about img:hover {
        transform: scale(1.05);
    }

    .about ul {
        list-style: none;
        padding: 0;
    }

    .about ul li {
        margin-bottom: 10px;
        font-size: 15px;
        display: flex;
        align-items: center;
    }

    .about ul li i {
        color: #0d6efd;
        margin-left: 8px;
    }

    [dir="rtl"] .about ul li i {
        margin-left: 0;
        margin-right: 8px;
    }

    .about-details {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-top: 30px;
    }

    .profile-intro {
        font-size: 18px;
        line-height: 1.8;
        padding: 20px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 10px;
        margin-bottom: 30px;
        border-left: 5px solid #0d6efd;
        text-align: justify;
    }

    [dir="rtl"] .profile-intro {
        border-left: none;
        border-right: 5px solid #0d6efd;
    }

    .skill-tags {
        margin-top: 20px;
    }

    .skill-tag {
        display: inline-block;
        background: #e9ecef;
        color: #495057;
        padding: 8px 18px;
        border-radius: 20px;
        margin: 5px;
        font-size: 14px;
        transition: all 0.3s ease;
        border: 1px solid #dee2e6;
    }

    .skill-tag:hover {
        background: #0d6efd;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }

    @media (max-width: 991px) {
        .about .content {
            text-align: center;
        }
        .about ul {
            display: inline-block;
            text-align: left;
        }
        
        [dir="rtl"] .about ul {
            text-align: right;
        }
    }

    /* ===== MODERN Portfolio Section ===== */
    .portfolio {
        padding: 100px 0;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        position: relative;
        overflow: hidden;
    }

    .portfolio::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 20% 50%, rgba(0, 123, 255, 0.05) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(0, 188, 212, 0.05) 0%, transparent 50%);
    }

    .portfolio .section-title {
        position: relative;
        z-index: 1;
        margin-bottom: 60px;
    }

    .portfolio .section-title h2 {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 15px;
        color: #1e293b;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
    }

    .portfolio .section-title h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #007bff, #00bcd4);
        border-radius: 2px;
    }

    .portfolio .section-title p {
        color: #64748b;
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Portfolio Filter Buttons - Modern Design */
    .portfolio-filters {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 50px;
        position: relative;
        z-index: 1;
    }

    .filter-btn {
        padding: 12px 28px;
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        color: #475569;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
    }

    .filter-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
        transition: left 0.5s;
    }

    .filter-btn:hover::before {
        left: 100%;
    }

    .filter-btn i {
        font-size: 1.1rem;
        transition: transform 0.3s ease;
    }

    .filter-btn:hover i {
        transform: translateY(-2px);
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: linear-gradient(135deg, #007bff 0%, #00bcd4 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 123, 255, 0.2);
    }

    /* ===== التعديل المهم: عرض البطاقات بجوار بعض ===== */
    .portfolio-container {
        position: relative;
        z-index: 1;
        width: 100%;
    }

    /* استبدال الـ Grid بالـ Flexbox */
    .portfolio-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        padding: 20px 0;
        justify-content: center;
        align-items: stretch;
    }

    /* جعل البطاقات بنفس العرض وتظهر بجوار بعض */
    .portfolio-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        height: auto;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(0, 0, 0, 0.05);
        opacity: 1 !important;
        transform: translateY(0) !important;
        /* عرض ثابت للبطاقات */
        width: calc(33.333% - 20px); /* 3 بطاقات في الصف مع مسافات */
        min-width: 300px;
        max-width: 400px;
    }

    @media (max-width: 1200px) {
        .portfolio-card {
            width: calc(50% - 20px); /* 2 بطاقات في الصف للشاشات المتوسطة */
        }
    }

    @media (max-width: 768px) {
        .portfolio-card {
            width: calc(50% - 15px); /* 2 بطاقات مع مسافة أقل */
            min-width: 250px;
        }
    }

    @media (max-width: 576px) {
        .portfolio-card {
            width: 100%; /* بطاقة واحدة في الصف للجوال */
            min-width: auto;
            max-width: 400px;
        }
        
        .portfolio-grid {
            justify-content: center;
        }
    }

    .portfolio-card:hover {
        transform: translateY(-12px) !important;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        border-color: rgba(0, 123, 255, 0.2);
    }

    .card-image {
        position: relative;
        overflow: hidden;
        height: 240px;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 25px;
        flex-shrink: 0;
    }

    .card-image img {
        width: auto;
        height: auto;
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 12px;
        background: white;
        padding: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .portfolio-card:hover .card-image img {
        transform: scale(1.08);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 30%, rgba(0, 0, 0, 0.8) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: flex-end;
        padding: 25px;
        pointer-events: none;
        border-radius: 20px 20px 0 0;
    }

    .portfolio-card:hover .image-overlay {
        opacity: 1;
    }

    .tech-stack {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
    }

    .tech-tag {
        background: rgba(255, 255, 255, 0.95);
        color: #007bff;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .tech-tag:hover {
        background: #007bff;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
    }

    .card-content {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        background: white;
        min-height: 300px;
    }

    .card-content h3 {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #1e293b;
        line-height: 1.4;
        text-align: center;
    }

    .card-content p {
        color: #64748b;
        line-height: 1.7;
        margin-bottom: 25px;
        flex-grow: 1;
        font-size: 1rem;
        text-align: center;
        padding: 0 10px;
    }

    .card-date {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #94a3b8;
        font-size: 0.9rem;
        margin-bottom: 25px;
        justify-content: center;
        background: #f8fafc;
        padding: 10px 20px;
        border-radius: 12px;
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
    }

    .card-date i {
        color: #007bff;
        font-size: 1.1rem;
    }

    .card-actions {
        display: flex;
        gap: 15px;
        margin-top: auto;
        justify-content: center;
    }

    .card-btn {
        flex: 1;
        padding: 14px 24px;
        border-radius: 12px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 0.95rem;
        max-width: 220px;
        min-width: 140px;
    }

    .card-btn.primary {
        background: linear-gradient(135deg, #007bff, #00bcd4);
        color: white;
        border: none;
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.2);
    }

    .card-btn.secondary {
        background: transparent;
        color: #007bff;
        border: 2px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .card-btn:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0, 123, 255, 0.25);
    }

    .card-btn.secondary:hover {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }

    /* Empty State */
    .empty-portfolio {
        width: 100%;
        text-align: center;
        padding: 100px 30px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        margin: 30px 0;
    }

    .empty-icon {
        font-size: 5rem;
        color: #cbd5e1;
        margin-bottom: 25px;
        opacity: 0.6;
    }

    .empty-portfolio h3 {
        color: #64748b;
        margin-bottom: 20px;
        font-size: 1.8rem;
        font-weight: 600;
    }

    .empty-portfolio p {
        color: #94a3b8;
        max-width: 500px;
        margin: 0 auto;
        font-size: 1.1rem;
        line-height: 1.7;
    }

    /* تحسين الارتفاعات لتناسب البطاقات */
    @media (max-width: 992px) {
        .portfolio {
            padding: 80px 0;
        }
        
        .portfolio .section-title h2 {
            font-size: 2.4rem;
        }
        
        .portfolio .section-title p {
            font-size: 1.05rem;
            max-width: 600px;
        }
        
        .portfolio-filters {
            margin-bottom: 40px;
        }
        
        .filter-btn {
            padding: 11px 24px;
            font-size: 0.9rem;
        }
        
        .card-content {
            padding: 25px;
            min-height: 280px;
        }
        
        .card-image {
            height: 220px;
            padding: 20px;
        }
    }

    @media (max-width: 768px) {
        .portfolio {
            padding: 70px 0;
        }
        
        .portfolio .section-title h2 {
            font-size: 2rem;
            padding-bottom: 12px;
        }
        
        .portfolio .section-title h2::after {
            width: 60px;
            height: 3px;
        }
        
        .portfolio .section-title p {
            font-size: 1rem;
            padding: 0 20px;
        }
        
        .portfolio-filters {
            gap: 10px;
            margin-bottom: 35px;
        }
        
        .filter-btn {
            padding: 10px 20px;
            font-size: 0.85rem;
        }
        
        .card-content {
            padding: 22px;
            min-height: 260px;
        }
        
        .card-content h3 {
            font-size: 1.3rem;
        }
        
        .card-content p {
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .card-actions {
            gap: 12px;
        }
        
        .card-btn {
            padding: 12px 20px;
            font-size: 0.9rem;
        }
        
        .card-image {
            height: 200px;
            padding: 18px;
        }
        
        .card-image img {
            padding: 12px;
        }
        
        .empty-portfolio {
            padding: 80px 25px;
        }
    }

    @media (max-width: 576px) {
        .portfolio {
            padding: 60px 0;
        }
        
        .portfolio .section-title h2 {
            font-size: 1.8rem;
        }
        
        .portfolio .section-title p {
            font-size: 0.95rem;
        }
        
        .portfolio-filters {
            flex-direction: column;
            align-items: stretch;
            gap: 8px;
            max-width: 300px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .filter-btn {
            width: 100%;
            justify-content: center;
            padding: 12px 20px;
            font-size: 0.9rem;
        }
        
        .card-content {
            padding: 20px;
            min-height: 240px;
        }
        
        .card-content h3 {
            font-size: 1.2rem;
            margin-bottom: 12px;
        }
        
        .card-content p {
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        
        .card-date {
            font-size: 0.85rem;
            padding: 8px 16px;
            margin-bottom: 20px;
        }
        
        .card-actions {
            flex-direction: column;
            gap: 10px;
        }
        
        .card-btn {
            width: 100%;
            max-width: 100%;
            padding: 12px 20px;
            font-size: 0.9rem;
        }
        
        .card-image {
            height: 180px;
            padding: 15px;
        }
        
        .card-image img {
            padding: 10px;
            max-width: 85%;
        }
        
        .tech-tag {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
        
        .empty-portfolio {
            padding: 60px 20px;
            margin: 20px 10px;
        }
        
        .empty-icon {
            font-size: 4rem;
        }
        
        .empty-portfolio h3 {
            font-size: 1.5rem;
        }
        
        .empty-portfolio p {
            font-size: 1rem;
        }
        
        .language-switcher {
            top: 15px;
            right: 15px;
        }
        
        [dir="rtl"] .language-switcher {
            left: 15px;
            right: auto;
        }
        
        .lang-btn {
            width: 45px;
            height: 45px;
        }
        
        .flag-icon {
            font-size: 22px;
        }
    }

    @media (max-width: 380px) {
        .portfolio .section-title h2 {
            font-size: 1.6rem;
        }
        
        .portfolio-grid {
            gap: 20px;
        }
        
        .card-image {
            height: 160px;
        }
        
        .card-content {
            padding: 18px;
            min-height: 220px;
        }
        
        .filter-btn {
            padding: 10px 16px;
            font-size: 0.85rem;
        }
    }

    /* ===== Fix for Image Brightness ===== */
    .profile-img-fix {
        filter: brightness(1.1) contrast(1.05);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    /* تحسين الصور العامة */
    img {
        max-width: 100%;
        height: auto;
        display: block;
    }

    /* تحسين أداء الجوال */
    @media (max-width: 576px) {
        .hero h2 {
            font-size: 2rem;
        }
        
        .section-title h2 {
            font-size: 1.8rem;
        }
        
        .portfolio-card {
            margin-bottom: 20px;
        }
    }

    /* ===== Animation for portfolio cards ===== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .portfolio-card {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 1;
        transform: translateY(0);
    }

    /* Stagger animation delays */
    .portfolio-card:nth-child(1) { animation-delay: 0.1s; }
    .portfolio-card:nth-child(2) { animation-delay: 0.2s; }
    .portfolio-card:nth-child(3) { animation-delay: 0.3s; }
    .portfolio-card:nth-child(4) { animation-delay: 0.4s; }
    .portfolio-card:nth-child(5) { animation-delay: 0.5s; }
    .portfolio-card:nth-child(6) { animation-delay: 0.6s; }
    
    /* إزالة التنسيقات المتعارضة */
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }
 </style>
  
</head>

<body class="index-page">

  <header id="header" class="header d-flex flex-column justify-content-center">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i><span>{{ __('messages.home') }}</span></a></li>
        <li><a href="#about"><i class="bi bi-person navicon"></i><span>{{ __('messages.about') }}</span></a></li>
        <li><a href="#portfolio"><i class="bi bi-images navicon"></i><span>{{ __('messages.portfolio') }}</span></a></li>
        <li><a href="#services"><i class="bi bi-hdd-stack navicon"></i><span>{{ __('messages.services') }}</span></a></li>
        <li><a href="#contact"><i class="bi bi-envelope navicon"></i><span>{{ __('messages.contact') }}</span></a></li>
      </ul>
    </nav>

    <!-- Language Switcher Fixed -->
    {{-- <div class="language-switcher">
      @php
          $currentLocale = app()->getLocale();
      @endphp
      
      <!-- اللغة العربية -->
      <a href="{{ $currentLocale == 'ar' ? '#' : url('/') }}" 
         class="lang-btn {{ $currentLocale == 'ar' ? 'active' : '' }}"
         title="العربية"
         @if($currentLocale == 'ar') onclick="return false;" @endif>
          <div class="flag-icon">🇸🇦</div>
          <span class="lang-tooltip">العربية</span>
          @if($currentLocale == 'ar')
              <span class="lang-indicator"></span>
          @endif
      </a>
      
      <!-- اللغة الإنجليزية -->
      <a href="{{ $currentLocale == 'en' ? '#' : url('/en') }}" 
         class="lang-btn {{ $currentLocale == 'en' ? 'active' : '' }}"
         title="English"
         @if($currentLocale == 'en') onclick="return false;" @endif>
          <div class="flag-icon">🇺🇸</div>
          <span class="lang-tooltip">English</span>
          @if($currentLocale == 'en')
              <span class="lang-indicator"></span>
          @endif
      </a>
    </div> --}}
  </header>

  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
      <img src="{{ asset('assets/img/hero-bg.jpg') }}" alt="Hero Background" loading="lazy">
      <div class="container" data-aos="zoom-out">
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <h2>{{ $settings->site_name ?? __('messages.site_name') }}</h2>
            <p>{{ __('messages.hero_subtitle') }} <span class="typed" data-typed-items="{{ __('messages.hero_items') }}"></span></p>
            <div class="social-links">
              @if($settings && $settings->social_links)
                @php
                  $socialLinks = is_array($settings->social_links) 
                    ? $settings->social_links 
                    : (is_string($settings->social_links) ? json_decode($settings->social_links, true) : []);
                @endphp
                
                @if(!empty($socialLinks))
                  @foreach($socialLinks as $platform => $link)
                    @if($link)
                      @switch($platform)
                        @case('twitter')
                          <a href="{{ $link }}" target="_blank" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                          @break
                        @case('facebook')
                          <a href="{{ $link }}" target="_blank" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                          @break
                        @case('instagram')
                          <a href="{{ $link }}" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                          @break
                        @case('linkedin')
                          <a href="{{ $link }}" target="_blank" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                          @break
                        @case('github')
                          <a href="{{ $link }}" target="_blank" aria-label="GitHub"><i class="bi bi-github"></i></a>
                          @break
                        @case('youtube')
                          <a href="{{ $link }}" target="_blank" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                          @break
                        @default
                          <a href="{{ $link }}" target="_blank" aria-label="{{ ucfirst($platform) }}"><i class="bi bi-link-45deg"></i></a>
                      @endswitch
                    @endif
                  @endforeach
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('messages.about_title') }}</h2>
        <p>{{ __('messages.about_description') }}</p>
      </div>
    
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        @php
            // Static intro text in Arabic
            $staticIntroAr = "بدأت رحلتي في البرمجة بشغف لتعلّم لارافيل وبناء مشاريع صغيرة عززت تجربتي العملية. مع مرور الوقت، توسعت مهاراتي لتشمل HTML، CSS، Bootstrap، JavaScript، PHP، Python، و SQL. أنا طالب في أمن المعلومات، أسعى لرفع مستواي المهني نحو التخصص في الأمن السيبراني والعمل كمطور مستقل.
    
    أؤمن بأن كل مشروع يمثل فرصة للتعلم وأن التفاصيل الصغيرة تحدث فرقًا كبيرًا. لذلك، ألتزم بالتفاني والدقة والعمل الدقيق في كل ما أقوم به.";
    
            // Static intro text in English
            $staticIntroEn = "I started my programming journey with a passion for learning Laravel and building small projects that enhanced my practical experience. Over time, my skills expanded to include HTML, CSS, Bootstrap, JavaScript, PHP, Python, and SQL. I am an information security student, striving to elevate my professional level towards expertise in cybersecurity and work as a freelance developer.
    
    I believe that every project is a learning opportunity and that small details make a big difference. Therefore, I am committed to dedication, precision, and meticulous work in everything I do.";
    
            // Default data in Arabic
            $defaultAboutAr = [
                'title' => 'مطور ويب متكامل',
                'description' => 'أنا مطور ويب متخصص في إنشاء تطبيقات ويب مبتكرة باستخدام أحدث التقنيات.',
                'image' => 'assets/img/profile-img.jpg',
                'details' => [
                    ['label' => 'الموقع', 'value' => 'www.omar.dev'],
                    ['label' => 'الهاتف', 'value' => '+966 50 123 4567'],
                    ['label' => 'المدينة', 'value' => 'الرياض، المملكة العربية السعودية'],
                    ['label' => 'الدرجة العلمية', 'value' => 'بكالوريوس علوم الحاسب'],
                    ['label' => 'البريد الإلكتروني', 'value' => 'contact@omar.dev'],
                    ['label' => 'العمل الحر', 'value' => 'متاح'],
                ],
                'extra' => 'متخصص في إنشاء حلول ويب مبتكرة باستخدام لارافيل، Vue.js، وأطر العمل الحديثة. ملتزم بتقديم تطبيقات عالية الجودة وقابلة للتطوير.'
            ];
    
            // Default data in English
            $defaultAboutEn = [
                'title' => 'Full Stack Web Developer',
                'description' => 'I am a web developer specializing in creating innovative web applications using the latest technologies.',
                'image' => 'assets/img/profile-img.jpg',
                'details' => [
                    ['label' => 'Website', 'value' => 'www.omar.dev'],
                    ['label' => 'Phone', 'value' => '+966 50 123 4567'],
                    ['label' => 'City', 'value' => 'Riyadh, Saudi Arabia'],
                    ['label' => 'Degree', 'value' => 'Bachelor of Computer Science'],
                    ['label' => 'Email', 'value' => 'contact@omar.dev'],
                    ['label' => 'Freelance', 'value' => 'Available'],
                ],
                'extra' => 'Specialized in creating innovative web solutions using Laravel, Vue.js, and modern frameworks. Committed to delivering high-quality and scalable applications.'
            ];
    
            // Determine which default data to use based on language
            $defaultAbout = app()->getLocale() == 'ar' ? $defaultAboutAr : $defaultAboutEn;
            $staticIntro = app()->getLocale() == 'ar' ? $staticIntroAr : $staticIntroEn;
    
            // Determine final data from database
            $aboutData = $about ?: (object) $defaultAbout;
            
            // Get image from database if exists
            $profileImage = null;
            if ($about && $about->image) {
                $profileImage = asset('storage/' . $about->image);
            } else {
                $profileImage = $defaultAbout['image'];
            }
            
            // Extract details from database if available
            $detailsFromDB = [];
            if ($about && isset($about->details)) {
                if (is_string($about->details)) {
                    $detailsFromDB = json_decode($about->details, true) ?: [];
                } elseif (is_array($about->details)) {
                    $detailsFromDB = $about->details;
                }
            }
            
            // Merge details
            $finalDetails = !empty($detailsFromDB) ? $detailsFromDB : $defaultAbout['details'];
            
            // Technical skills from database or defaults
            $skills = ['HTML5', 'CSS3', 'Bootstrap 5', 'JavaScript ES6+', 'PHP 8', 'Laravel 10', 'Python', 'MySQL', 'Git & GitHub', 'RESTful APIs'];
            if ($about && $about->skills) {
                if (is_string($about->skills)) {
                    $decodedSkills = json_decode($about->skills, true);
                    $skills = $decodedSkills !== null ? $decodedSkills : $skills;
                } elseif (is_array($about->skills)) {
                    $skills = $about->skills;
                }
            }
        @endphp
    
        <div class="row gy-4 justify-content-center align-items-center">
          <!-- Profile Image from Database -->
          <div class="col-lg-4 col-md-6" data-aos="fade-right">
            <div class="profile-image-container">
              <img src="{{ $profileImage }}" 
                   class="img-fluid rounded-4 shadow-lg" 
                   alt="{{ app()->getLocale() == 'ar' ? 'صورة الملف الشخصي' : 'Profile Image' }}"
                   style="max-height: 500px; object-fit: cover; width: 100%; border: 5px solid #0d6efd;">
              
              <!-- Image decoration -->
              <div class="image-decoration position-absolute top-0 start-0 w-100 h-100 rounded-4" 
                   style="border: 3px solid rgba(13, 110, 253, 0.3); pointer-events: none;"></div>
              
              <!-- Hover effect -->
              <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 rounded-4 d-flex align-items-center justify-content-center"
                   style="background: rgba(13, 110, 253, 0.1); opacity: 0; transition: opacity 0.3s ease;">
                <i class="bi bi-person-circle text-white" style="font-size: 3rem;"></i>
              </div>
            </div>
            
            <!-- Quick info under image -->
            @if($about && $about->title)
            <div class="quick-info mt-4 text-center" data-aos="fade-up" data-aos-delay="200">
              <h5 class="fw-bold mb-2">{{ $about->title }}</h5>
              @if($about && $about->experience)
              <p class="text-muted mb-0">
                <i class="bi bi-briefcase me-2"></i>
                {{ $about->experience }}
              </p>
              @endif
            </div>
            @endif
          </div>
          
          <!-- Content -->
          <div class="col-lg-8 col-md-6 content" data-aos="fade-left">
            <!-- Main Title -->
            <h2 class="mb-4">{{ $aboutData->title ?? $defaultAbout['title'] }}</h2>
            
            <!-- Static Intro -->
            <div class="profile-intro mb-4">
              <p style="white-space: pre-line;">{{ $staticIntro }}</p>
            </div>
            
            <!-- Content from Database -->
            @if($about && $about->content)
              <div class="database-content mb-4">
                {!! $about->content !!}
              </div>
            @else
              <p class="fst-italic mb-4">{{ $defaultAbout['description'] }}</p>
              <p class="mb-4">{{ $defaultAbout['extra'] }}</p>
            @endif
            
            <!-- Technical Skills -->
            <div class="skill-tags mb-4">
              <h5 class="mb-3">{{ __('messages.technical_skills') }}:</h5>
              @foreach($skills as $skill)
                <span class="skill-tag">{{ $skill }}</span>
              @endforeach
            </div>
            
            <!-- Personal Details -->
            <div class="about-details">
              <h4 class="mb-4">{{ __('messages.personal_info') }}</h4>
              <div class="row">
                <div class="col-lg-6">
                  <ul>
                    @foreach(array_slice($finalDetails, 0, 3) as $item)
                      @if(is_array($item) && isset($item['label']) && isset($item['value']))
                        <li>
                          <i class="bi bi-chevron-right"></i> 
                          <strong>{{ $item['label'] }}:</strong> 
                          <span>{{ $item['value'] }}</span>
                        </li>
                      @elseif(is_object($item))
                        <li>
                          <i class="bi bi-chevron-right"></i> 
                          <strong>{{ $item->label ?? __('messages.information') }}:</strong> 
                          <span>{{ $item->value ?? __('messages.not_specified') }}</span>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul>
                    @foreach(array_slice($finalDetails, 3) as $item)
                      @if(is_array($item) && isset($item['label']) && isset($item['value']))
                        <li>
                          <i class="bi bi-chevron-right"></i> 
                          <strong>{{ $item['label'] }}:</strong> 
                          <span>{{ $item['value'] }}</span>
                        </li>
                      @elseif(is_object($item))
                        <li>
                          <i class="bi bi-chevron-right"></i> 
                          <strong>{{ $item->label ?? __('messages.information') }}:</strong> 
                          <span>{{ $item->value ?? __('messages.not_specified') }}</span>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                </div>
              </div>
              
              <!-- Additional info from database -->
              @if($about && ($about->languages || $about->location || $about->email))
              <div class="row mt-4">
                @if($about->languages)
                <div class="col-md-4">
                  <div class="info-box p-3 bg-light rounded-3">
                    <i class="bi bi-translate text-primary fs-4 mb-2"></i>
                    <h6 class="fw-bold">{{ __('messages.languages') }}</h6>
                    <p class="mb-0">{{ $about->languages }}</p>
                  </div>
                </div>
                @endif
                
                @if($about->location)
                <div class="col-md-4">
                  <div class="info-box p-3 bg-light rounded-3">
                    <i class="bi bi-geo-alt text-primary fs-4 mb-2"></i>
                    <h6 class="fw-bold">{{ __('messages.location') }}</h6>
                    <p class="mb-0">{{ $about->location }}</p>
                  </div>
                </div>
                @endif
                
                @if($about->email)
                <div class="col-md-4">
                  <div class="info-box p-3 bg-light rounded-3">
                    <i class="bi bi-envelope text-primary fs-4 mb-2"></i>
                    <h6 class="fw-bold">{{ __('messages.email') }}</h6>
                    <p class="mb-0">{{ $about->email }}</p>
                  </div>
                </div>
                @endif
              </div>
              @endif
            </div>
            
            <!-- Download CV Button -->
            @if($about && $about->cv)
            <div class="mt-4" data-aos="fade-up" data-aos-delay="300">
              <a href="{{ asset('storage/' . $about->cv) }}" 
                 class="btn btn-primary btn-lg px-4 py-3"
                 target="_blank"
                 download>
                <i class="bi bi-download me-2"></i>
                {{ __('messages.download_cv') }}
              </a>
            </div>
            @endif
          </div>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="stats section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-emoji-smile"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="{{ $testimonials->count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{ __('messages.happy_clients') }}</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-journal-richtext"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="{{ $projects->count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{ __('messages.projects') }}</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-headset"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{ __('messages.hours_support') }}</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-people"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="{{ $services->count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{ __('messages.services_count') }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- MODERN Portfolio Section -->
    <section id="portfolio" class="portfolio section">
      <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
          <h2>{{ __('messages.portfolio_title') }}</h2>
          <p>{{ __('messages.portfolio_description') }}</p>
        </div>

        <!-- Portfolio Filters -->
        <div class="portfolio-filters" data-aos="fade-up" data-aos-delay="100">
          <button class="filter-btn active" data-filter="*">
            <i class="bi bi-grid-3x3-gap-fill"></i>
            {{ __('All Projects') }}
          </button>
          <button class="filter-btn" data-filter=".web">
            <i class="bi bi-laptop"></i>
            {{ __('Web Development') }}
          </button>
          <button class="filter-btn" data-filter=".mobile">
            <i class="bi bi-phone"></i>
            {{ __('Mobile Apps') }}
          </button>
          <button class="filter-btn" data-filter=".design">
            <i class="bi bi-brush"></i>
            {{ __('UI/UX Design') }}
          </button>
        </div>

        <!-- Portfolio Grid -->
        <div class="portfolio-container">
          @if($projects && $projects->count() > 0)
            <div class="portfolio-grid">
              @foreach($projects as $project)
                @php
                  // تحديد فئة المشروع
                  $categoryClass = 'web';
                  if ($project->category) {
                    $categoryClass = strtolower($project->category);
                  }
                  
                  // تكنولوجيا المشروع
                  $techStack = ['Laravel', 'Vue.js', 'Bootstrap', 'MySQL'];
                  if ($project->technologies) {
                    if (is_array($project->technologies)) {
                      $techStack = $project->technologies;
                    } else {
                      $decodedTech = json_decode($project->technologies, true);
                      $techStack = ($decodedTech !== null) ? $decodedTech : $techStack;
                    }
                  }
                  
                  // الحصول على صورة المشروع
                  $projectImage = $project->image ? asset('storage/' . $project->image) : 
                    asset('assets/img/portfolio/portfolio-' . (($loop->index % 6) + 1) . '.jpg');
                @endphp
                
                <div class="portfolio-card {{ $categoryClass }}" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                  <div class="card-image">
                    <img src="{{ $projectImage }}" alt="{{ $project->title }}" loading="lazy">
                    <div class="image-overlay">
                      <div class="tech-stack">
                        @foreach(array_slice($techStack, 0, 3) as $tech)
                          <span class="tech-tag">{{ $tech }}</span>
                        @endforeach
                        @if(count($techStack) > 3)
                          <span class="tech-tag">+{{ count($techStack) - 3 }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="card-content">
                    <h3>{{ $project->title }}</h3>
                    <p>{{ Str::limit($project->description, 100) }}</p>
                    
                    <div class="card-date">
                      <i class="bi bi-calendar3"></i>
                      <span>{{ $project->created_at ? $project->created_at->format('M Y') : 'Recent' }}</span>
                    </div>
                    
                    <div class="card-actions">
                      @if($project->slug)
                        <a href="{{ route('projects.show', $project->slug) }}" class="card-btn primary">
                          <i class="bi bi-eye"></i>
                          {{ __('View Details') }}
                        </a>
                      @endif
                      @if($project->link)
                        <a href="{{ $project->link }}" target="_blank" class="card-btn secondary">
                          <i class="bi bi-link-45deg"></i>
                          {{ __('Live Demo') }}
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <!-- Empty State -->
            <div class="empty-portfolio" data-aos="fade-up">
              <div class="empty-icon">
                <i class="bi bi-folder-x"></i>
              </div>
              <h3>{{ __('No Projects Yet') }}</h3>
              <p>{{ __('I am currently working on new projects. Check back soon to see my latest work!') }}</p>
            </div>
          @endif
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services section">
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('messages.services_title') }}</h2>
        <p>{{ __('messages.services_description') }}</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          @foreach($services as $index => $service)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
              <div class="service-item item-{{ ['cyan', 'orange', 'teal', 'red', 'indigo', 'pink'][$index % 6] }} position-relative">
                <div class="icon">
                  <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                  </svg>
                  @if($service->icon)
                    <i class="bi bi-{{ $service->icon }}"></i>
                  @else
                    <i class="bi bi-code-slash"></i>
                  @endif
                </div>
                <h3>{{ $service->title }}</h3>
                <p>{{ $service->description }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('messages.testimonials_title') }}</h2>
        <p>{{ __('messages.testimonials_description') }}</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        @if($testimonials->count() > 0)
          <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                }
              }
            </script>
            <div class="swiper-wrapper">
              @foreach($testimonials as $testimonial)
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <div class="row gy-4 justify-content-center">
                      <div class="col-lg-6">
                        <div class="testimonial-content">
                          <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ $testimonial->message }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                          </p>
                          <h3>{{ $testimonial->name }}</h3>
                          @if($testimonial->role)
                            <h4>{{ $testimonial->role }}</h4>
                          @endif
                          <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                          </div>
                        </div>
                      </div>
                      @if($testimonial->avatar)
                        <div class="col-lg-2 text-center">
                          <img src="{{ asset('storage/' . $testimonial->avatar) }}" class="img-fluid testimonial-img" alt="{{ $testimonial->name }}" loading="lazy">
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="swiper-pagination"></div>
          </div>
        @else
          <div class="text-center py-5">
            <p>{{ __('messages.no_testimonials') }}</p>
          </div>
        @endif
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('messages.contact_title') }}</h2>
        <p>{{ __('messages.contact_description') }}</p>
      </div>

      <div class="container" data-aos="fade" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-4">
            @if($settings)
              @if($settings->email)
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                    <h3>{{ __('messages.email') }}</h3>
                    <p>{{ $settings->email }}</p>
                  </div>
                </div>
              @endif

              @if($settings->phone)
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone flex-shrink-0"></i>
                  <div>
                    <h3>{{ __('messages.phone') }}</h3>
                    <p>{{ $settings->phone }}</p>
                  </div>
                </div>
              @endif
            @endif
          </div>

          <div class="col-lg-8">
            <form id="contact-form" class="php-email-form" data-aos="fade-up" data-aos-delay="200" action="{{ url('/contact') }}" method="POST">
              @csrf
              
              <div class="row gy-4">
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="{{ __('messages.name_placeholder') }}" required>
                  <div class="invalid-feedback" id="name-error"></div>
                </div>

                <div class="col-md-6">
                  <input type="email" name="email" class="form-control" placeholder="{{ __('messages.email_placeholder') }}" required>
                  <div class="invalid-feedback" id="email-error"></div>
                </div>

                <div class="col-md-12">
                  <input type="text" name="subject" class="form-control" placeholder="{{ __('messages.subject_placeholder') }}" required>
                  <div class="invalid-feedback" id="subject-error"></div>
                </div>

                <div class="col-md-12">
                  <textarea name="message" class="form-control" rows="6" placeholder="{{ __('messages.message_placeholder') }}" required></textarea>
                  <div class="invalid-feedback" id="message-error"></div>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">{{ __('messages.loading') }}</div>
                  <div class="error-message"></div>
                  <div class="sent-message">{{ __('messages.success_message') }}</div>

                  <button type="submit">{{ __('messages.send_button') }}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer id="footer" class="footer position-relative light-background">
    <div class="container">
      <h3 class="sitename">{{ $settings->site_name ?? __('messages.site_name') }}</h3>
      <p>{{ __('messages.footer_text') }}</p>
      <div class="social-links d-flex justify-content-center">
        @if($settings && $settings->social_links)
          @php
            $socialLinks = is_array($settings->social_links) 
              ? $settings->social_links 
              : (is_string($settings->social_links) ? json_decode($settings->social_links, true) : []);
          @endphp
          
          @foreach($socialLinks as $platform => $link)
            @if($link)
              @switch($platform)
                @case('twitter')
                  <a href="{{ $link }}" target="_blank" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                  @break
                @case('facebook')
                  <a href="{{ $link }}" target="_blank" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                  @break
                @case('instagram')
                  <a href="{{ $link }}" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                  @break
                @case('linkedin')
                  <a href="{{ $link }}" target="_blank" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                  @break
              @endswitch
            @endif
          @endforeach
        @endif
      </div>
      <div class="container">
        <div class="copyright">
          <span>{{ __('messages.copyright') }}</span> <strong class="px-1 sitename">{{ $settings->site_name ?? __('messages.site_name') }}</strong> <span>{{ __('messages.all_rights') }}</span>
        </div>
        <div class="credits">
          {{ __('Designed by') }} <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/typed.js/typed.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Language Switcher
        const langButtons = document.querySelectorAll('.lang-btn:not(.active)');
        
        langButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.classList.contains('active')) {
                    e.preventDefault();
                    return;
                }
                
                // Add loading effect
                const originalHTML = this.innerHTML;
                this.innerHTML = '<div class="flag-icon">⏳</div>';
                
                // Restore after 500ms
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                }, 500);
            });
        });
        
        // Portfolio Filter Functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const portfolioCards = document.querySelectorAll('.portfolio-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                const filterValue = this.getAttribute('data-filter');
                
                // Filter portfolio cards
                portfolioCards.forEach(card => {
                    if (filterValue === '*' || card.classList.contains(filterValue.replace('.', ''))) {
                        card.style.display = 'flex';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 100);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Contact Form Submission
        const contactForm = document.getElementById('contact-form');
        
        if (contactForm) {
            contactForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Reset messages
                const messages = {
                    loading: contactForm.querySelector('.loading'),
                    error: contactForm.querySelector('.error-message'),
                    success: contactForm.querySelector('.sent-message')
                };
                
                Object.values(messages).forEach(msg => msg.style.display = 'none');
                
                // Show loading
                messages.loading.style.display = 'block';
                
                // Clear previous errors
                contactForm.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
                
                try {
                    const formData = new FormData(contactForm);
                    const response = await fetch(contactForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok && data.success) {
                        contactForm.reset();
                        messages.success.style.display = 'block';
                        
                        // Hide success message after 5 seconds
                        setTimeout(() => {
                            messages.success.style.display = 'none';
                        }, 5000);
                    } else {
                        // Display validation errors
                        if (data.errors) {
                            Object.entries(data.errors).forEach(([field, errors]) => {
                                const input = contactForm.querySelector(`[name="${field}"]`);
                                const errorDiv = document.getElementById(`${field}-error`);
                                
                                if (input && errorDiv) {
                                    input.classList.add('is-invalid');
                                    errorDiv.textContent = errors[0];
                                }
                            });
                        }
                        
                        messages.error.style.display = 'block';
                        messages.error.textContent = data.message || '{{ __("messages.error_message") }}';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    messages.error.style.display = 'block';
                    messages.error.textContent = '{{ __("messages.network_error") }}';
                } finally {
                    messages.loading.style.display = 'none';
                }
            });
        }
        
        // Add scroll animations for portfolio cards
        const portfolioCardsAll = document.querySelectorAll('.portfolio-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        });
        
        portfolioCardsAll.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    });
  </script>
</body>
</html>