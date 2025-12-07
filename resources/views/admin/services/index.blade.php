@extends('layouts.app')

@section('title', 'الخدمات')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">الخدمات</h1>
        <a href="{{ route('services.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">إضافة خدمة</a>
    </div>

    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="min-w-full border border-gray-300 dark:border-gray-600">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="p-3 text-center text-gray-700 dark:text-gray-200">الأيقونة</th>
                    <th class="p-3 text-left text-gray-700 dark:text-gray-200">العنوان</th>
                    <th class="p-3 text-left text-gray-700 dark:text-gray-200">الوصف</th>
                    <th class="p-3 text-center text-gray-700 dark:text-gray-200">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800">
                @foreach($services as $service)
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                    <td class="p-3 text-center">
                        @if($service->icon)
                            <img src="{{ asset('storage/' . $service->icon) }}" class="w-12 h-12 object-cover rounded mx-auto shadow-sm">
                        @else
                            <span class="text-gray-400 dark:text-gray-500">لا توجد أيقونة</span>
                        @endif
                    </td>
                    <td class="p-3 text-gray-800 dark:text-gray-200">{{ $service->title }}</td>
                    <td class="p-3 text-gray-700 dark:text-gray-300">{{ Str::limit($service->description, 60) }}</td>
                    <td class="p-3 text-center flex justify-center gap-2">
                        <a href="{{ route('services.edit', $service->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-3 py-1 rounded transition">تعديل</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
