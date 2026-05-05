<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | {{ config('app.name') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Cairo', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f8fafc;
        }
        .sidebar-link.active {
            background-color: #2563eb;
            color: white;
        }
    </style>
    @yield('styles')
</head>
<body class="font-sans antialiased">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6">
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-white flex items-center gap-2">
                    <i class="bi bi-speedometer2 text-blue-500"></i>
                    لوحة التحكم
                </a>
            </div>
            
            <nav class="flex-1 px-4 space-y-2 mt-4">
                <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house"></i> الرئيسية
                </a>
                
                <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">الإدارة</div>
                
                <a href="{{ route('admin.projects.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="bi bi-kanban"></i> المشاريع
                </a>
                
                <a href="{{ route('admin.services.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i> الخدمات
                </a>
                
                <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-quote"></i> التقييمات
                </a>
                
                <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">الإعدادات</div>
                
                <a href="{{ route('admin.about.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i> نبذة عني
                </a>
                
                <a href="{{ route('admin.settings.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i> إعدادات الموقع
                </a>
            </nav>
            
            <div class="p-4 border-t border-slate-800">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors text-blue-400">
                    <i class="bi bi-box-arrow-up-right"></i> عرض الموقع
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-900/20 text-red-400 transition-colors">
                        <i class="bi bi-box-arrow-right"></i> تسجيل الخروج
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-8">
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-slate-600">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                    <h2 class="text-xl font-bold text-slate-800">@yield('title', 'الرئيسية')</h2>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="flex flex-col text-left items-end">
                        <span class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-slate-500">{{ auth()->user()->email }}</span>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=2563eb&color=fff" class="w-10 h-10 rounded-full border border-slate-200">
                </div>
            </header>

            <!-- Main Scrollable Content -->
            <main class="flex-1 overflow-y-auto p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg flex items-center gap-3">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg flex items-center gap-3">
                        <i class="bi bi-exclamation-octagon-fill"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
