@extends('layouts.admin')

@section('title', 'إعدادات الموقع')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-3xl">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
        <div>
            <h3 class="text-lg font-bold text-slate-800">الإعدادات العامة</h3>
            <p class="text-sm text-slate-500">تحكم في المعلومات الأساسية للموقع والروابط.</p>
        </div>
        <a href="{{ route('admin.settings.edit', $settings->id) }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
            <i class="bi bi-gear-fill"></i> تعديل الإعدادات
        </a>
    </div>

    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">اسم الموقع</label>
                <div class="text-slate-800 font-bold text-lg">{{ $settings->site_name }}</div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">البريد الإلكتروني</label>
                <div class="text-slate-800 font-bold">{{ $settings->email }}</div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">الهاتف</label>
                <div class="text-slate-800 font-bold font-mono">{{ $settings->phone }}</div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">الوضع الداكن الافتراضي</label>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold {{ $settings->dark_mode ? 'bg-slate-800 text-slate-200' : 'bg-amber-100 text-amber-700' }}">
                    <i class="bi bi-{{ $settings->dark_mode ? 'moon-fill' : 'sun-fill' }}"></i>
                    {{ $settings->dark_mode ? 'مفعل' : 'غير مفعل' }}
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-100">
            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">روابط التواصل الاجتماعي</label>
            <div class="flex flex-wrap gap-4">
                @php $links = is_array($settings->social_links) ? $settings->social_links : (json_decode($settings->social_links, true) ?: []); @endphp
                @foreach($links as $platform => $url)
                    @if($url)
                        <div class="flex items-center gap-2 bg-slate-50 px-4 py-2 rounded-lg border border-slate-200">
                            <i class="bi bi-{{ $platform === 'twitter' ? 'twitter-x' : $platform }} text-blue-600"></i>
                            <span class="text-sm font-bold text-slate-700">{{ ucfirst($platform) }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

