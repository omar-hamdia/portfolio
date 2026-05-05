@extends('layouts.admin')

@section('title', 'تعديل المشروع')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800">تعديل بيانات المشروع</h3>
            <p class="text-sm text-slate-500">قم بتحديث معلومات المشروع {{ $project->title }} هنا.</p>
        </div>

        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Title AR/EN --}}
                <div class="col-span-1">
                    <label for="title" class="block text-sm font-bold text-slate-700 mb-2">عنوان المشروع (عربي)</label>
                    <input type="text" name="title" id="title" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('title', $project->title) }}" required>
                    @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="col-span-1">
                    <label for="title_en" class="block text-sm font-bold text-slate-700 mb-2">Project Title (English)</label>
                    <input type="text" name="title_en" id="title_en" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('title_en', $project->title_en) }}" dir="ltr" required>
                    @error('title_en') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Description AR/EN --}}
                <div class="col-span-1">
                    <label for="description" class="block text-sm font-bold text-slate-700 mb-2">وصف مختصر (عربي)</label>
                    <textarea name="description" id="description" rows="3" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" required>{{ old('description', $project->description) }}</textarea>
                    @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="col-span-1">
                    <label for="description_en" class="block text-sm font-bold text-slate-700 mb-2">Short Description (English)</label>
                    <textarea name="description_en" id="description_en" rows="3" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" dir="ltr" required>{{ old('description_en', $project->description_en) }}</textarea>
                    @error('description_en') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Main Image --}}
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <label for="image" class="block text-sm font-bold text-slate-700 mb-2">صورة الغلاف الحالية</label>
                    <div class="mb-4 w-32 h-32 rounded-lg overflow-hidden border border-slate-200">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                <i class="bi bi-image text-slate-300"></i>
                            </div>
                        @endif
                    </div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">تغيير الصورة</label>
                    <input type="file" name="image" id="image" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all" accept="image/*">
                    @error('image') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Video --}}
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <label for="video" class="block text-sm font-bold text-slate-700 mb-2">فيديو المشروع</label>
                    @if($project->video)
                        <div class="mb-4 text-xs text-blue-600 flex items-center gap-2">
                            <i class="bi bi-play-circle-fill"></i> يوجد فيديو مرفوع مسبقاً
                        </div>
                    @endif
                    <label class="block text-sm font-bold text-slate-700 mb-2">تغيير الفيديو</label>
                    <input type="file" name="video" id="video" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100 transition-all" accept="video/*">
                    @error('video') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Multiple Images --}}
                <div class="col-span-2 p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <label class="block text-sm font-bold text-slate-700 mb-2">صور المعرض الحالية</label>
                    <div class="flex flex-wrap gap-3 mb-6">
                        @if($project->images)
                            @foreach($project->images as $img)
                                <div class="w-20 h-20 rounded-lg overflow-hidden border border-slate-200 shadow-sm relative group">
                                    <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        @else
                            <p class="text-xs text-slate-400">لا توجد صور إضافية</p>
                        @endif
                    </div>
                    <label for="images" class="block text-sm font-bold text-slate-700 mb-2">إضافة/تغيير صور المعرض (سوف يتم استبدال القديمة)</label>
                    <input type="file" name="images[]" id="images" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all" accept="image/*" multiple>
                    @error('images') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- GitHub --}}
                <div>
                    <label for="github" class="block text-sm font-bold text-slate-700 mb-2">رابط GitHub</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400">
                            <i class="bi bi-github"></i>
                        </span>
                        <input type="url" name="github" id="github" class="w-full border border-slate-300 rounded-lg pr-10 pl-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('github', $project->github) }}" placeholder="https://github.com/...">
                    </div>
                    @error('github') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Project Link --}}
                <div>
                    <label for="link" class="block text-sm font-bold text-slate-700 mb-2">رابط المشروع</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400">
                            <i class="bi bi-link-45deg"></i>
                        </span>
                        <input type="url" name="link" id="link" class="w-full border border-slate-300 rounded-lg pr-10 pl-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" value="{{ old('link', $project->link) }}" placeholder="https://...">
                    </div>
                    @error('link') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.projects.index') }}" class="px-6 py-2.5 rounded-lg text-slate-600 font-bold hover:bg-slate-100 transition-all">إلغاء</a>
                <button type="submit" class="px-10 py-2.5 rounded-lg bg-amber-500 text-white font-bold hover:bg-amber-600 shadow-lg shadow-amber-500/30 transition-all">تحديث المشروع</button>
            </div>
        </form>
    </div>
</div>
@endsection

