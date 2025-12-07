@extends('layouts.app')

@section('title', 'إضافة مشروع جديد')

@section('content')
<div class="container mx-auto mt-10 max-w-xl px-4">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800 dark:text-gray-200">إضافة مشروع جديد</h1>

    <form id="projectForm" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transition-all duration-300">
        @csrf

        {{-- Title --}}
        <div class="mb-5">
            <label for="title" class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">العنوان</label>
            <input type="text" name="title" id="title" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-5">
            <label for="description" class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">الوصف</label>
            <textarea name="description" id="description" rows="4" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" required>{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Image --}}
        <div class="mb-5">
            <label for="image" class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">صورة المشروع</label>
            <input type="file" name="image" id="image" class="w-full border rounded px-4 py-2 dark:bg-gray-700 dark:border-gray-600 transition" accept="image/*">
            <img id="previewImage" src="#" alt="معاينة الصورة" class="mt-4 hidden w-48 h-48 object-cover rounded shadow-md">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Video --}}
        <div class="mb-5">
            <label for="video" class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">فيديو المشروع (اختياري)</label>
            <input type="file" name="video" id="video" class="w-full border rounded px-4 py-2 dark:bg-gray-700 dark:border-gray-600 transition" accept="video/*">
            @error('video')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- GitHub --}}
        <div class="mb-5">
            <label for="github" class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">رابط GitHub (اختياري)</label>
            <input type="url" name="github" id="github" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" value="{{ old('github') }}">
            @error('github')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Project Link --}}
        <div class="mb-5">
            <label for="link" class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">رابط المشروع (اختياري)</label>
            <input type="url" name="link" id="link" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" value="{{ old('link') }}">
            @error('link')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded transition">إضافة المشروع</button>
            <a href="{{ route('projects.index') }}" class="text-gray-500 hover:underline">إلغاء</a>
        </div>
    </form>
</div>

<script>
    const imageInput = document.getElementById('image');
    const previewImage = document.getElementById('previewImage');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.setAttribute('src', e.target.result);
                previewImage.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    const form = document.getElementById('projectForm');
    form.addEventListener('submit', function(e) {
        if(!confirm('هل أنت متأكد من إضافة المشروع؟')) e.preventDefault();
    });
</script>
@endsection
