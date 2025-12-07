@extends('Layouts.app')

@section('title', 'الإعدادات')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-2xl mb-6">الإعدادات العامة</h1>

    <a href="{{ route('admin.settings.edit', $settings->id) }}" class="btn btn-primary">تعديل الإعدادات</a>

    <div class="mt-4">
        <p><strong>اسم الموقع:</strong> {{ $settings->site_name }}</p>
        <p><strong>البريد الإلكتروني:</strong> {{ $settings->email }}</p>
        <p><strong>الهاتف:</strong> {{ $settings->phone }}</p>
        <p><strong>روابط التواصل الاجتماعي:</strong> {{ json_encode($settings->social_links) }}</p>
        <p><strong>الوضع الداكن:</strong> {{ $settings->dark_mode ? 'مفعل' : 'غير مفعل' }}</p>
    </div>
</div>
@endsection
