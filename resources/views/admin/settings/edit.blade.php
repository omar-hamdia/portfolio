@extends('Layouts.app')

@section('title', 'تعديل الإعدادات')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-2xl mb-6">تعديل الإعدادات</h1>

    <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">اسم الموقع</label>
        <input type="text" name="site_name" value="{{ $setting->site_name }}" class="w-full mb-4 p-2 border rounded">

        <label class="block mb-2">البريد الإلكتروني</label>
        <input type="email" name="email" value="{{ $setting->email }}" class="w-full mb-4 p-2 border rounded">

        <label class="block mb-2">الهاتف</label>
        <input type="text" name="phone" value="{{ $setting->phone }}" class="w-full mb-4 p-2 border rounded">

        <label class="block mb-2">روابط التواصل الاجتماعي (JSON)</label>
        <textarea name="social_links" class="w-full mb-4 p-2 border rounded" rows="4">{{ json_encode($setting->social_links) }}</textarea>

        <label class="inline-flex items-center mb-4">
            <input type="checkbox" name="dark_mode" {{ $setting->dark_mode ? 'checked' : '' }} class="mr-2">
            تفعيل الوضع الداكن
        </label>

        <button type="submit" class="btn btn-success">تحديث</button>
    </form>
</div>
@endsection
