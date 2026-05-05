@extends('layouts.admin')

@section('title', 'إضافة رأي جديد')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800">إضافة رأي عميل جديد</h3>
            <p class="text-sm text-slate-500">أضف تقييماً جديداً ليظهر في قسم التقييمات.</p>
        </div>

        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">اسم العميل</label>
                    <input type="text" name="name" id="name" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('name') }}" required placeholder="مثال: أحمد محمد">
                    @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label for="role" class="block text-sm font-bold text-slate-700 mb-2">المسمى الوظيفي</label>
                    <input type="text" name="role" id="role" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('role') }}" placeholder="مثال: مدير مشاريع">
                    @error('role') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Message --}}
            <div>
                <label for="message" class="block text-sm font-bold text-slate-700 mb-2">نص التقييم</label>
                <textarea name="message" id="message" rows="4" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" required placeholder="ماذا قال العميل عنك؟">{{ old('message') }}</textarea>
                @error('message') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Avatar --}}
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                <label for="avatar" class="block text-sm font-bold text-slate-700 mb-2">الصورة الشخصية (اختياري)</label>
                <input type="file" name="avatar" id="avatar" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all" accept="image/*">
                @error('avatar') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-2.5 rounded-lg text-slate-600 font-bold hover:bg-slate-100 transition-all">إلغاء</a>
                <button type="submit" class="px-10 py-2.5 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all">إضافة التقييم</button>
            </div>
        </form>
    </div>
</div>
@endsection
