@extends('layouts.admin')

@section('title', 'تعديل الخدمة')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800">تعديل بيانات الخدمة</h3>
            <p class="text-sm text-slate-500">تحديث معلومات الخدمة: {{ $service->title }}</p>
        </div>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Title AR/EN --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-bold text-slate-700 mb-2">عنوان الخدمة (عربي)</label>
                        <input type="text" name="title" id="title" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('title', $service->title) }}" required>
                        @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="title_en" class="block text-sm font-bold text-slate-700 mb-2">Service Title (English)</label>
                        <input type="text" name="title_en" id="title_en" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('title_en', $service->title_en) }}" dir="ltr" required>
                        @error('title_en') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Description AR/EN --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="description" class="block text-sm font-bold text-slate-700 mb-2">وصف الخدمة (عربي)</label>
                        <textarea name="description" id="description" rows="4" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" required>{{ old('description', $service->description) }}</textarea>
                        @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="description_en" class="block text-sm font-bold text-slate-700 mb-2">Service Description (English)</label>
                        <textarea name="description_en" id="description_en" rows="4" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" dir="ltr" required>{{ old('description_en', $service->description_en) }}</textarea>
                        @error('description_en') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Icon --}}
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 flex flex-col md:flex-row gap-6">
                    <div class="w-24 h-24 rounded-2xl bg-white border border-slate-200 flex items-center justify-center overflow-hidden flex-shrink-0">
                        @if($service->icon)
                            <img src="{{ asset('storage/' . $service->icon) }}" class="w-full h-full object-cover">
                        @else
                            <i class="bi bi-image text-slate-300 text-3xl"></i>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label for="icon" class="block text-sm font-bold text-slate-700 mb-2">تغيير الأيقونة</label>
                        <input type="file" name="icon" id="icon" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all" accept="image/*">
                        @error('icon') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.services.index') }}" class="px-6 py-2.5 rounded-lg text-slate-600 font-bold hover:bg-slate-100 transition-all">إلغاء</a>
                <button type="submit" class="px-10 py-2.5 rounded-lg bg-amber-500 text-white font-bold hover:bg-amber-600 shadow-lg shadow-amber-500/30 transition-all">حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>
@endsection

