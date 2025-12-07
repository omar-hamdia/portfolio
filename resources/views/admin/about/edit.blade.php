@extends('layouts.app')

@section('title', 'تعديل النبذة')

@section('content')
<div class="container mx-auto mt-10 px-4">

    <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data"
          class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
        @csrf
        @method('PUT')

        <label class="block mb-2 text-gray-700 dark:text-gray-300">المحتوى</label>
        <textarea name="content" rows="6"
                  class="w-full p-3 rounded bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200">{{ $about->content }}</textarea>

        <label class="block mt-4 mb-2 text-gray-700 dark:text-gray-300">الصورة (اختياري)</label>
        <input type="file" name="image" class="w-full mb-4">

        @if($about->image)
            <img src="{{ asset('storage/' . $about->image) }}" class="w-40 rounded mb-4 shadow">
        @endif

        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
            تحديث
        </button>
    </form>

</div>
@endsection
