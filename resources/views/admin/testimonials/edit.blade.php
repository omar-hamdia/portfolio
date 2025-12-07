@extends('layouts.app')

@section('title', 'تعديل الشهادة')

@section('content')
<div class="container mx-auto mt-10 max-w-lg px-4">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800 dark:text-gray-200">تعديل الشهادة</h1>

    <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transition-all duration-300">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-5">
            <label for="name" class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">الاسم</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 transition" value="{{ old('name', $testimonial->name) }}" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Role --}}
        <div class="mb-5">
            <label for="role" class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">المسمى الوظيفي (اختياري)</label>
            <input type="text" name="role" id="role" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 transition" value="{{ old('role', $testimonial->role) }}">
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Message --}}
        <div class="mb-5">
            <label for="message" class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">الرسالة</label>
            <textarea name="message" id="message" rows="4" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 transition" required>{{ old('message', $testimonial->message) }}</textarea>
            @error('message')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Avatar --}}
        <div class="mb-5">
            <label for="avatar" class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">الصورة الشخصية (اختياري)</label>
            <input type="file" name="avatar" id="avatar" class="w-full border rounded px-4 py-2 dark:bg-gray-700 dark:border-gray-600 transition" accept="image/*">
            @if($testimonial->avatar)
                <img id="previewAvatar" src="{{ asset('storage/' . $testimonial->avatar) }}" class="mt-4 w-20 h-20 object-cover rounded-full shadow-md mx-auto">
            @else
                <img id="previewAvatar" src="#" class="mt-4 hidden w-20 h-20 object-cover rounded-full shadow-md mx-auto">
            @endif
            @error('avatar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded transition">تحديث الشهادة</button>
            <a href="{{ route('testimonials.index') }}" class="text-gray-500 hover:underline">إلغاء</a>
        </div>
    </form>
</div>

<script>
    const avatarInput = document.getElementById('avatar');
    const previewAvatar = document.getElementById('previewAvatar');

    avatarInput.addEventListener('change', function() {
        const file = this.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewAvatar.setAttribute('src', e.target.result);
                previewAvatar.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const confirmed = confirm('هل أنت متأكد من تحديث الشهادة؟');
        if(!confirmed) e.preventDefault();
    });
</script>
@endsection
