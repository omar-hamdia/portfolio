@extends('layouts.app')

@section('title', 'إضافة نبذة')

@section('content')
<div class="container mx-auto mt-10 px-4">

    <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
        @csrf

        <label class="block mb-2 text-gray-700 dark:text-gray-300">المحتوى</label>
        <textarea name="content" rows="6"
                  class="w-full p-3 rounded bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200">{{ old('content') }}</textarea>

        <label class="block mt-4 mb-2 text-gray-700 dark:text-gray-300">الصورة (اختياري)</label>
        <input type="file" name="image" class="w-full mb-4">

        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            حفظ
        </button>
    </form>

</div>
@endsection
