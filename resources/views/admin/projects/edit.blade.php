@extends('layouts.app')

@section('title', 'تعديل المشروع')

@section('content')
<div class="container mx-auto mt-10 max-w-xl">
    <h1 class="text-3xl font-bold mb-6 text-center">تعديل المشروع</h1>

    <form id="projectForm" action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transition-all duration-300">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-5">
            <label for="title" class="block font-semibold mb-2">العنوان</label>
            <input type="text" name="title" id="title" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" value="{{ old('title', $project->title) }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-5">
            <label for="description" class="block font-semibold mb-2">الوصف</label>
            <textarea name="description" id="description" rows="4" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" required>{{ old('description', $project->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Image --}}
        <div class="mb-5">
            <label for="image" class="block font-semibold mb-2">صورة المشروع</label>
            <input type="file" name="image" id="image" class="w-full border rounded px-4 py-2 dark:bg-gray-700 dark:border-gray-600 transition" accept="image/*">
            @if($project->image)
                <img id="previewImage" src="{{ asset('storage/' . $project->image) }}" class="mt-4 w-48 h-48 object-cover rounded shadow-md">
            @else
                <img id="previewImage" src="#" alt="معاينة الصورة" class="mt-4 hidden w-48 h-48 object-cover rounded shadow-md">
            @endif
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Project Link --}}
        <div class="mb-5">
            <label for="link" class="block font-semibold mb-2">رابط المشروع</label>
            <input type="url" name="link" id="link" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" value="{{ old('link', $project->link) }}">
            @error('link')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- GitHub Link --}}
        <div class="mb-5">
            <label for="github" class="block font-semibold mb-2">رابط GitHub</label>
            <input type="url" name="github" id="github" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" value="{{ old('github', $project->github) }}">
            @error('github')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Video --}}
        <div class="mb-5">
            <label for="video" class="block font-semibold mb-2">رابط الفيديو (اختياري)</label>
            <input type="url" name="video" id="video" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" value="{{ old('video', $project->video) }}">
            @if($project->video)
                <iframe class="mt-4 w-full h-48 rounded shadow-md" src="{{ $project->video }}" frameborder="0" allowfullscreen></iframe>
            @endif
            @error('video')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded transition">تحديث المشروع</button>
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
        const confirmed = confirm('هل أنت متأكد من تحديث المشروع؟');
        if(!confirmed) e.preventDefault();
    });
</script>
@endsection
