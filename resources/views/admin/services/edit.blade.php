@extends('layouts.app')

@section('title', 'تعديل الخدمة')

@section('content')
<div class="container mx-auto mt-10 max-w-xl">
    <h1 class="text-3xl font-bold mb-6 text-center">تعديل الخدمة</h1>

    <form id="serviceForm" action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transition-all duration-300">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-5">
            <label for="title" class="block font-semibold mb-2">عنوان الخدمة</label>
            <input type="text" name="title" id="title" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" value="{{ old('title', $service->title) }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-5">
            <label for="description" class="block font-semibold mb-2">وصف الخدمة</label>
            <textarea name="description" id="description" rows="4" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 transition" required>{{ old('description', $service->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Icon --}}
        <div class="mb-5">
            <label for="icon" class="block font-semibold mb-2">أيقونة الخدمة (اختياري)</label>
            <input type="file" name="icon" id="icon" class="w-full border rounded px-4 py-2 dark:bg-gray-700 dark:border-gray-600 transition" accept="image/*">
            @if($service->icon)
                <img id="previewIcon" src="{{ asset('storage/' . $service->icon) }}" alt="معاينة الأيقونة" class="mt-4 w-20 h-20 object-cover rounded shadow-md">
            @else
                <img id="previewIcon" src="#" alt="معاينة الأيقونة" class="mt-4 w-20 h-20 object-cover rounded shadow-md hidden">
            @endif
            @error('icon')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded transition">حفظ التعديلات</button>
            <a href="{{ route('services.index') }}" class="text-gray-500 hover:underline">إلغاء</a>
        </div>
    </form>
</div>

<script>
    // معاينة الأيقونة قبل الرفع
    const iconInput = document.getElementById('icon');
    const previewIcon = document.getElementById('previewIcon');

    iconInput.addEventListener('change', function() {
        const file = this.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewIcon.setAttribute('src', e.target.result);
                previewIcon.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // تأكيد قبل الإرسال
    const form = document.getElementById('serviceForm');
    form.addEventListener('submit', function(e) {
        const confirmed = confirm('هل أنت متأكد من حفظ التعديلات؟');
        if(!confirmed) e.preventDefault();
    });
</script>
@endsection
