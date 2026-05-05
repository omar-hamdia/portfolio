@extends('layouts.admin')

@section('title', 'تعديل التقييم')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800">تعديل رأي العميل</h3>
            <p class="text-sm text-slate-500">تحديث بيانات التقييم الخاص بـ: {{ $testimonial->name }}</p>
        </div>

        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Name AR/EN --}}
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">اسم العميل (عربي)</label>
                    <input type="text" name="name" id="name" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('name', $testimonial->name) }}" required>
                    @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="name_en" class="block text-sm font-bold text-slate-700 mb-2">Client Name (English)</label>
                    <input type="text" name="name_en" id="name_en" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('name_en', $testimonial->name_en) }}" dir="ltr" required>
                    @error('name_en') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Role AR/EN --}}
                <div>
                    <label for="role" class="block text-sm font-bold text-slate-700 mb-2">المسمى الوظيفي (عربي)</label>
                    <input type="text" name="role" id="role" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('role', $testimonial->role) }}">
                    @error('role') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="role_en" class="block text-sm font-bold text-slate-700 mb-2">Job Role (English)</label>
                    <input type="text" name="role_en" id="role_en" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('role_en', $testimonial->role_en) }}" dir="ltr">
                    @error('role_en') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Message AR/EN --}}
                <div>
                    <label for="message" class="block text-sm font-bold text-slate-700 mb-2">نص التقييم (عربي)</label>
                    <textarea name="message" id="message" rows="4" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" required>{{ old('message', $testimonial->message) }}</textarea>
                    @error('message') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="message_en" class="block text-sm font-bold text-slate-700 mb-2">Testimonial Message (English)</label>
                    <textarea name="message_en" id="message_en" rows="4" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" dir="ltr" required>{{ old('message_en', $testimonial->message_en) }}</textarea>
                    @error('message_en') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Avatar --}}
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 flex items-center gap-6">
                <div class="w-20 h-20 rounded-full bg-white border border-slate-200 flex items-center justify-center overflow-hidden flex-shrink-0">
                    @if($testimonial->avatar)
                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <i class="bi bi-person text-slate-300 text-3xl"></i>
                    @endif
                </div>
                <div class="flex-1">
                    <label for="avatar" class="block text-sm font-bold text-slate-700 mb-2">تغيير الصورة الشخصية</label>
                    <input type="file" name="avatar" id="avatar" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all" accept="image/*">
                    @error('avatar') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-2.5 rounded-lg text-slate-600 font-bold hover:bg-slate-100 transition-all">إلغاء</a>
                <button type="submit" class="px-10 py-2.5 rounded-lg bg-amber-500 text-white font-bold hover:bg-amber-600 shadow-lg shadow-amber-500/30 transition-all">حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>
@endsection

