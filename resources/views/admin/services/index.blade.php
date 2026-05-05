@extends('layouts.admin')

@section('title', 'إدارة الخدمات')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
        <div>
            <h3 class="text-lg font-bold text-slate-800">قائمة الخدمات</h3>
            <p class="text-sm text-slate-500">هنا يمكنك إدارة الخدمات التي تقدمها لعملائك.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
            <i class="bi bi-plus-lg"></i> إضافة خدمة جديدة
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-right">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm">الأيقونة</th>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm">العنوان</th>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm">الوصف</th>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm text-center">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach($services as $service)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 rounded-lg overflow-hidden border border-slate-200 flex-shrink-0 mx-auto">
                            @if($service->icon)
                                <img src="{{ asset('storage/' . $service->icon) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <i class="bi bi-briefcase text-slate-400"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $service->title }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-600 line-clamp-2 max-w-xs">{{ $service->description }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="inline-flex items-center gap-1 bg-amber-50 text-amber-600 px-3 py-1.5 rounded-md hover:bg-amber-500 hover:text-white transition-all text-sm font-bold">
                                <i class="bi bi-pencil-square"></i> تعديل
                            </a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline">
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

