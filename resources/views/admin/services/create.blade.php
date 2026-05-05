@extends('layouts.admin')

@section('title', 'إضافة خدمة جديدة')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800">تفاصيل الخدمة الجديدة</h3>
            <p class="text-sm text-slate-500">أضف خدمة جديدة لتعرض في صفحة الخدمات.</p>
        </div>

        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            <div class="space-y-6">
                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-bold text-slate-700 mb-2">عنوان الخدمة</label>
                    <input type="text" name="title" id="title" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('title') }}" required placeholder="مثال: تطوير تطبيقات الويب">
                    @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-bold text-slate-700 mb-2">وصف الخدمة</label>
                    <textarea name="description" id="description" rows="4" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" required placeholder="اشرح باختصار ماذا تقدم في هذه الخدمة...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Icon --}}
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <label for="icon" class="block text-sm font-bold text-slate-700 mb-2">أيقونة الخدمة (اختياري)</label>
                    <input type="file" name="icon" id="icon" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all" accept="image/*">
                    <p class="text-[10px] text-slate-400 mt-2">يفضل أن تكون الأيقونة بخلفية شفافة (PNG) وبحجم صغير.</p>
                    @error('icon') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.services.index') }}" class="px-6 py-2.5 rounded-lg text-slate-600 font-bold hover:bg-slate-100 transition-all">إلغاء</a>
                <button type="submit" class="px-10 py-2.5 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all">إضافة الخدمة</button>
            </div>
        </form>
    </div>
</div>
@endsection

