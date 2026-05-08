@extends('layouts.admin')

@section('title', 'تعديل النبذة الشخصية')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800">تعديل معلومات الملف الشخصي</h3>
            <p class="text-sm text-slate-500">حدث نبذتك، مهاراتك، وصورتك الشخصية.</p>
        </div>

        <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Left: Image & CV -->
                <div class="lg:col-span-1 space-y-6">
                    {{-- AR Image --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">الصورة الشخصية (عربي)</label>
                        <div class="relative group">
                            <div class="aspect-square rounded-2xl overflow-hidden border-4 border-slate-100 shadow-lg bg-slate-50 flex items-center justify-center">
                                @if($about->image)
                                    <img id="imagePreview" src="{{ asset('storage/' . $about->image) }}" class="w-full h-full object-cover">
                                @else
                                    <i id="placeholderIcon" class="bi bi-person text-6xl text-slate-300"></i>
                                    <img id="imagePreview" src="#" class="w-full h-full object-cover hidden">
                                @endif
                            </div>
                            <label for="image" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer rounded-2xl">
                                <span class="text-white font-bold text-sm bg-white/20 px-4 py-2 rounded-full backdrop-blur-md">تغيير الصورة</span>
                                <input type="file" name="image" id="image" class="hidden" accept="image/*">
                            </label>
                        </div>
                        @error('image') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- EN Image --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Profile Image (English)</label>
                        <div class="relative group">
                            <div class="aspect-square rounded-2xl overflow-hidden border-4 border-slate-100 shadow-lg bg-slate-50 flex items-center justify-center">
                                @if($about->image_en)
                                    <img id="imagePreviewEn" src="{{ asset('storage/' . $about->image_en) }}" class="w-full h-full object-cover">
                                @else
                                    <i id="placeholderIconEn" class="bi bi-person text-6xl text-slate-300"></i>
                                    <img id="imagePreviewEn" src="#" class="w-full h-full object-cover hidden">
                                @endif
                            </div>
                            <label for="image_en" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer rounded-2xl">
                                <span class="text-white font-bold text-sm bg-white/20 px-4 py-2 rounded-full backdrop-blur-md">Change Photo</span>
                                <input type="file" name="image_en" id="image_en" class="hidden" accept="image/*">
                            </label>
                        </div>
                        @error('image_en') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <label for="cv" class="block text-sm font-bold text-slate-700 mb-2">السيرة الذاتية (PDF)</label>
                        <input type="file" name="cv" id="cv" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all" accept=".pdf">
                        @if($about->cv)
                            <div class="mt-2 text-[10px] text-green-600 font-bold flex items-center gap-1">
                                <i class="bi bi-check-circle-fill"></i> يوجد ملف مرفوع حالياً
                            </div>
                        @endif
                        @error('cv') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Right: Content & Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-bold text-slate-700 mb-2">العنوان الوظيفي (عربي)</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $about->title) }}" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <label for="title_en" class="block text-sm font-bold text-slate-700 mb-2">Job Title (English)</label>
                            <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $about->title_en) }}" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none" dir="ltr">
                        </div>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-bold text-slate-700 mb-2">النبذة التعريفية (عربي)</label>
                        <textarea name="content" id="content" rows="6" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none leading-relaxed">{{ old('content', $about->content) }}</textarea>
                        @error('content') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="content_en" class="block text-sm font-bold text-slate-700 mb-2">About Content (English)</label>
                        <textarea name="content_en" id="content_en" rows="6" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none leading-relaxed" dir="ltr">{{ old('content_en', $about->content_en) }}</textarea>
                        @error('content_en') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="skills" class="block text-sm font-bold text-slate-700 mb-2">التقنيات (مفصولة بفاصلة ,)</label>
                        @php
                            $skillsArray = json_decode($about->skills, true) ?: [];
                            $skillsString = is_array($skillsArray) ? implode(', ', $skillsArray) : '';
                        @endphp
                        <textarea name="skills" id="skills" rows="3" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none leading-relaxed" placeholder="PHP, Laravel, MySQL...">{{ old('skills', $skillsString) }}</textarea>
                        <p class="text-xs text-slate-500 mt-1">أدخل التقنيات التي تتقنها مفصولة بفاصلة.</p>
                        @error('skills') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
                <a href="{{ route('admin.about.index') }}" class="px-6 py-2.5 rounded-lg text-slate-600 font-bold hover:bg-slate-100 transition-all">إلغاء</a>
                <button type="submit" class="px-12 py-3 rounded-lg bg-blue-600 text-white font-black hover:bg-blue-700 shadow-xl shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">تحديث الملف الشخصي</button>
            </div>
        </form>
    </div>
</div>

<script>
    // AR Preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('imagePreview');
                const placeholder = document.getElementById('placeholderIcon');
                preview.src = event.target.result;
                preview.classList.remove('hidden');
                if(placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // EN Preview
    document.getElementById('image_en').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('imagePreviewEn');
                const placeholder = document.getElementById('placeholderIconEn');
                preview.src = event.target.result;
                preview.classList.remove('hidden');
                if(placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

