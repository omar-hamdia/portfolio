@extends('layouts.admin')

@section('title', 'تعديل إعدادات الموقع')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800">تحديث الإعدادات العامة</h3>
            <p class="text-sm text-slate-500">تحكم في هوية الموقع ومعلومات التواصل.</p>
        </div>

        <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Site Name AR/EN --}}
                <div>
                    <label for="site_name" class="block text-sm font-bold text-slate-700 mb-2">اسم الموقع (عربي)</label>
                    <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $setting->site_name) }}" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    @error('site_name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="site_name_en" class="block text-sm font-bold text-slate-700 mb-2">Site Name (English)</label>
                    <input type="text" name="site_name_en" id="site_name_en" value="{{ old('site_name_en', $setting->site_name_en) }}" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" dir="ltr">
                    @error('site_name_en') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">البريد الإلكتروني الرسمي</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $setting->email) }}" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                {{-- Phone --}}
                <div>
                    <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">رقم الهاتف</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone) }}" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                {{-- Dark Mode --}}
                <div class="col-span-2 p-4 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-between">
                    <div>
                        <label class="block text-sm font-bold text-slate-700">الوضع الداكن الافتراضي</label>
                        <p class="text-xs text-slate-500">تفعيل الوضع المظلم عند زيارة الموقع لأول مرة.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="dark_mode" value="1" {{ $setting->dark_mode ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                {{-- Social Links --}}
                <div class="col-span-2">
                    <h4 class="text-sm font-bold text-slate-700 mb-4 border-b border-slate-100 pb-2">روابط التواصل الاجتماعي</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php $links = is_array($setting->social_links) ? $setting->social_links : (json_decode($setting->social_links, true) ?: []); @endphp
                        @foreach(['github', 'linkedin', 'twitter', 'facebook', 'instagram'] as $platform)
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1 capitalize">{{ $platform }}</label>
                                <input type="url" name="social_links[{{ $platform }}]" value="{{ $links[$platform] ?? '' }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.settings.index') }}" class="px-6 py-2.5 rounded-lg text-slate-600 font-bold hover:bg-slate-100 transition-all">إلغاء</a>
                <button type="submit" class="px-10 py-2.5 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all">حفظ التغييرات</button>
            </div>
        </form>
    </div>
</div>
@endsection

