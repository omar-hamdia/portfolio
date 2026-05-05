@extends('layouts.admin')

@section('title', 'لوحة التحكم')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Visits Stat --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-2xl">
                <i class="bi bi-people"></i>
            </div>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">إجمالي الزوار</span>
        </div>
        <div class="text-3xl font-black text-slate-800">{{ $stats['total_visits'] }}</div>
        <div class="text-sm text-slate-500 mt-1">زائر فريد للموقع</div>
    </div>

    {{-- Today Visits Stat --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-lg flex items-center justify-center text-2xl">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">زوار اليوم</span>
        </div>
        <div class="text-3xl font-black text-slate-800">{{ $stats['today_visits'] }}</div>
        <div class="text-sm text-slate-500 mt-1">زوار في آخر 24 ساعة</div>
    </div>

    {{-- Projects Stat --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-2xl">
                <i class="bi bi-kanban"></i>
            </div>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">المشاريع</span>
        </div>
        <div class="text-3xl font-black text-slate-800">{{ $stats['projects_count'] }}</div>
        <div class="text-sm text-slate-500 mt-1">مشروعاً في المحفظة</div>
    </div>

    {{-- Services Stat --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center text-2xl">
                <i class="bi bi-briefcase"></i>
            </div>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">الخدمات</span>
        </div>
        <div class="text-3xl font-black text-slate-800">{{ $stats['services_count'] }}</div>
        <div class="text-sm text-slate-500 mt-1">خدمة مقدمة حالياً</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    {{-- Quick Actions --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800">إجراءات سريعة</h3>
        </div>
        <div class="p-6 grid grid-cols-2 gap-4">
            <a href="{{ route('admin.projects.create') }}" class="p-4 rounded-xl border border-slate-100 hover:border-blue-200 hover:bg-blue-50 transition-all flex flex-col items-center gap-2 group">
                <i class="bi bi-plus-circle text-2xl text-blue-500 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold text-slate-700">إضافة مشروع</span>
            </a>
            <a href="{{ route('admin.services.create') }}" class="p-4 rounded-xl border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50 transition-all flex flex-col items-center gap-2 group">
                <i class="bi bi-plus-circle text-2xl text-emerald-500 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold text-slate-700">إضافة خدمة</span>
            </a>
            <a href="{{ route('admin.about.index') }}" class="p-4 rounded-xl border border-slate-100 hover:border-amber-200 hover:bg-amber-50 transition-all flex flex-col items-center gap-2 group">
                <i class="bi bi-person-gear text-2xl text-amber-500 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold text-slate-700">تعديل النبذة</span>
            </a>
            <a href="{{ route('admin.settings.edit', 1) }}" class="p-4 rounded-xl border border-slate-100 hover:border-slate-300 hover:bg-slate-100 transition-all flex flex-col items-center gap-2 group">
                <i class="bi bi-gear text-2xl text-slate-500 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold text-slate-700">الإعدادات</span>
            </a>
        </div>
    </div>

    {{-- Recent Projects --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50/50 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-800">آخر المشاريع</h3>
            <a href="{{ route('admin.projects.index') }}" class="text-sm text-blue-600 font-bold hover:underline">عرض الكل</a>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse(\App\Models\Project::latest()->take(5)->get() as $p)
                <div class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                            @if($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" class="w-full h-full object-cover">
                            @else
                                <i class="bi bi-image text-slate-300 flex items-center justify-center h-full"></i>
                            @endif
                        </div>
                        <div>
                            <div class="font-bold text-slate-800 text-sm">{{ $p->title }}</div>
                            <div class="text-xs text-slate-400">{{ $p->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <a href="{{ route('admin.projects.edit', $p->id) }}" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-200 transition-all">
                        <i class="bi bi-pencil"></i>
                    </a>
                </div>
            @empty
                <div class="p-8 text-center text-slate-400">لا توجد مشاريع مضافة</div>
            @endforelse
        </div>
    </div>
</div>
@endsection

