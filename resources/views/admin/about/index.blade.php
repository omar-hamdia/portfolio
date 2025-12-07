@extends('layouts.app')

@section('title', 'نبذة عني')

@section('content')
<div class="container mx-auto mt-10 px-4">

    <div class="flex justify-end mb-4">
        @if(!$about)
            <a href="{{ route('admin.about.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded shadow">إضافة</a>
        @else
            <a href="{{ route('admin.about.edit', $about->id) }}" 
               class="bg-yellow-500 text-white px-4 py-2 rounded shadow">تعديل</a>
        @endif
    </div>

    <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
        @if($about)
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200">نبذة عني</h2>

            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                {!! nl2br(e($about->content)) !!}
            </p>

            @if($about->image)
                <img src="{{ asset('storage/' . $about->image) }}" 
                     class="mt-4 w-64 rounded shadow">
            @endif
        @else
            <p class="text-gray-500 dark:text-gray-400">لا يوجد محتوى حتى الآن.</p>
        @endif
    </div>
</div>
@endsection
