@extends('layouts.app')

@section('title', 'الشهادات')

@section('content')
<div class="container mx-auto mt-10 px-4">

    <!-- زر إضافة شهادة -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('testimonials.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            إضافة شهادة
        </a>
    </div>

    <!-- جدول الشهادات -->
    <div class="overflow-x-auto bg-white dark:bg-gray-900 shadow rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                    <th class="p-3 text-center">الصورة</th>
                    <th class="p-3 text-right">الاسم</th>
                    <th class="p-3 text-right">الوظيفة</th>
                    <th class="p-3 text-right">الرسالة</th>
                    <th class="p-3 text-center">الإجراءات</th>
                </tr>
            </thead>

            <tbody>
                @forelse($testimonials as $testimonial)
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition">

                    <!-- الصورة -->
                    <td class="p-3 text-center">
                        @if($testimonial->avatar)
                            <img src="{{ asset('storage/' . $testimonial->avatar) }}" 
                                 class="w-12 h-12 rounded-full object-cover mx-auto shadow">
                        @else
                            <span class="text-gray-400 text-sm">—</span>
                        @endif
                    </td>

                    <!-- الاسم -->
                    <td class="p-3 text-right text-gray-700 dark:text-gray-300">
                        {{ $testimonial->name }}
                    </td>

                    <!-- الوظيفة -->
                    <td class="p-3 text-right text-gray-600 dark:text-gray-400">
                        {{ $testimonial->role ?? '—' }}
                    </td>

                    <!-- الرسالة -->
                    <td class="p-3 text-right text-gray-600 dark:text-gray-400">
                        {{ Str::limit($testimonial->message, 60) }}
                    </td>

                    <!-- الإجراءات -->
                    <td class="p-3">
                        <div class="flex justify-center gap-2">

                            <!-- تعديل -->
                            <a href="{{ route('testimonials.edit', $testimonial->id) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded shadow">
                                تعديل
                            </a>

                            <!-- حذف -->
                            <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('هل أنت متأكد من الحذف؟')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow">
                                    حذف
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">
                        لا يوجد شهادات حالياً
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
