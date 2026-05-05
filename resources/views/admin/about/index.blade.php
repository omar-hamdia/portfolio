@extends('layouts.admin')

@section('title', 'إدارة نبذة عني')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
        <div>
            <h3 class="text-lg font-bold text-slate-800">إعدادات الملف الشخصي</h3>
            <p class="text-sm text-slate-500">هنا يمكنك التحكم بالمعلومات الشخصية والنبذة التعريفية المعروضة في الموقع.</p>
        </div>
        @if(!$about)
            <a href="{{ route('admin.about.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
                <i class="bi bi-plus-lg"></i> إضافة المعلومات
            </a>
        @else
            <a href="{{ route('admin.about.edit', $about->id) }}" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg font-semibold transition-all shadow-md">
                <i class="bi bi-pencil-square"></i> تعديل البيانات
            </a>
        @endif
    </div>

    <div class="p-8">
        @if($about)
            <div class="flex flex-col md:flex-row gap-10">
                <div class="w-full md:w-1/3">
                    <div class="rounded-2xl overflow-hidden border-4 border-slate-100 shadow-xl">
                        @if($about->image)
                            <img src="{{ asset('storage/' . $about->image) }}" class="w-full h-auto object-cover">
                        @else
                            <div class="aspect-square bg-slate-100 flex items-center justify-center">
                                <i class="bi bi-person text-6xl text-slate-300"></i>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="w-full md:w-2/3">
                    <h4 class="text-2xl font-black text-slate-800 mb-4">{{ $about->title ?? 'لا يوجد عنوان' }}</h4>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        {!! $about->content !!}
                    </div>
                    
                    @if($about->cv)
                        <div class="mt-8 p-4 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-3 text-slate-700">
                                <i class="bi bi-file-earmark-pdf text-2xl text-rose-500"></i>
                                <span class="font-bold">السيرة الذاتية (CV)</span>
                            </div>
                            <a href="{{ asset('storage/' . $about->cv) }}" target="_blank" class="text-blue-600 hover:underline font-bold">
                                عرض الملف <i class="bi bi-box-arrow-up-right text-xs"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center py-20 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                <i class="bi bi-person-exclamation text-6xl text-slate-300 mb-4 inline-block"></i>
                <h3 class="text-xl font-bold text-slate-400">لم تقم بإضافة بيانات "عني" حتى الآن</h3>
                <p class="text-slate-400 mt-2">أضف بياناتك لتظهر في الواجهة الأمامية للموقع.</p>
            </div>
        @endif
    </div>
</div>
@endsection

