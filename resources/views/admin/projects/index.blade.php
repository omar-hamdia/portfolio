@extends('layouts.admin')

@section('title', 'إدارة المشاريع')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
        <div>
            <h3 class="text-lg font-bold text-slate-800">قائمة المشاريع</h3>
            <p class="text-sm text-slate-500">هنا يمكنك إدارة كافة المشاريع المعروضة في الموقع.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
            <i class="bi bi-plus-lg"></i> إضافة مشروع جديد
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-right">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm">المشروع</th>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm">الوصف</th>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm text-center">الروابط</th>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm text-center">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach($projects as $project)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg overflow-hidden border border-slate-200 flex-shrink-0">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                        <i class="bi bi-image text-slate-400"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-slate-800">{{ $project->title }}</div>
                                <div class="text-xs text-slate-500">{{ $project->slug }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-600 line-clamp-2 max-w-xs">{{ $project->description }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            @if($project->link)
                                <a href="{{ $project->link }}" target="_blank" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all" title="رابط المشروع">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            @endif
                            @if($project->github)
                                <a href="{{ $project->github }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all" title="GitHub">
                                    <i class="bi bi-github"></i>
                                </a>
                            @endif
                            @if($project->video)
                                <a href="{{ asset('storage/' . $project->video) }}" target="_blank" class="w-8 h-8 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all" title="فيديو">
                                    <i class="bi bi-play-fill"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="inline-flex items-center gap-1 bg-amber-50 text-amber-600 px-3 py-1.5 rounded-md hover:bg-amber-500 hover:text-white transition-all text-sm font-bold">
                                <i class="bi bi-pencil-square"></i> تعديل
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 bg-rose-50 text-rose-600 px-3 py-1.5 rounded-md hover:bg-rose-600 hover:text-white transition-all text-sm font-bold" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    <i class="bi bi-trash"></i> حذف
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

