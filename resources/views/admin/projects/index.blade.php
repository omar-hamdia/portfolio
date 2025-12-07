@extends('layouts.app')

@section('title', 'المشاريع')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">المشاريع</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">إضافة مشروع</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="p-3 text-left text-gray-700 dark:text-gray-200">العنوان</th>
                    <th class="p-3 text-left text-gray-700 dark:text-gray-200">الوصف</th>
                    <th class="p-3 text-center text-gray-700 dark:text-gray-200">صورة</th>
                    <th class="p-3 text-center text-gray-700 dark:text-gray-200">فيديو</th>
                    <th class="p-3 text-center text-gray-700 dark:text-gray-200">GitHub</th>
                    <th class="p-3 text-center text-gray-700 dark:text-gray-200">الرابط</th>
                    <th class="p-3 text-center text-gray-700 dark:text-gray-200">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800">
                @foreach($projects as $project)
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                    <td class="p-3 text-gray-800 dark:text-gray-100">{{ $project->title }}</td>
                    <td class="p-3 text-gray-800 dark:text-gray-100">{{ Str::limit($project->description, 50) }}</td>
                    <td class="p-3 text-center">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" class="w-16 h-16 object-cover rounded shadow-sm">
                        @endif
                    </td>
                    <td class="p-3 text-center">
                        @if($project->video)
                            <a href="{{ asset('storage/' . $project->video) }}" target="_blank" class="text-blue-500 hover:underline">عرض الفيديو</a>
                        @endif
                    </td>
                    <td class="p-3 text-center">
                        @if($project->github)
                            <a href="{{ $project->github }}" target="_blank" class="text-blue-500 hover:underline">GitHub</a>
                        @endif
                    </td>
                    <td class="p-3 text-center">
                        @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" class="text-blue-500 hover:underline">زيارة المشروع</a>
                        @endif
                    </td>
                    <td class="p-3 text-center flex justify-center gap-2">
                        <a href="{{ route('projects.edit', $project->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-800 px-3 py-1 rounded transition">تعديل</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
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
