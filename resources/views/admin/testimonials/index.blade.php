@extends('layouts.admin')

@section('title', 'إدارة التقييمات')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
        <div>
            <h3 class="text-lg font-bold text-slate-800">قائمة التقييمات</h3>
            <p class="text-sm text-slate-500">هنا يمكنك إدارة آراء العملاء المعروضة في الموقع.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
            <i class="bi bi-plus-lg"></i> إضافة تقييم جديد
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-right">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm text-center">العميل</th>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm">الاسم</th>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm">الوظيفة</th>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm">الرسالة</th>
                    <th class="px-6 py-4 text-slate-600 font-bold text-sm text-center">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($testimonials as $testimonial)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-200 flex-shrink-0 mx-auto">
                            @if($testimonial->avatar)
                                <img src="{{ asset('storage/' . $testimonial->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <i class="bi bi-person text-slate-400"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $testimonial->name }}</div>
                    </td>
                    <td class="px-6 py-4 text-slate-600">
                        {{ $testimonial->role ?? '—' }}
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-600 line-clamp-2 max-w-xs">{{ $testimonial->message }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="inline-flex items-center gap-1 bg-amber-50 text-amber-600 px-3 py-1.5 rounded-md hover:bg-amber-500 hover:text-white transition-all text-sm font-bold">
                                <i class="bi bi-pencil-square"></i> تعديل
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 bg-rose-50 text-rose-600 px-3 py-1.5 rounded-md hover:bg-rose-600 hover:text-white transition-all text-sm font-bold" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    <i class="bi bi-trash"></i> حذف
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                        <i class="bi bi-chat-left-dots text-4xl block mb-2"></i>
                        لا توجد تقييمات حالياً
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

