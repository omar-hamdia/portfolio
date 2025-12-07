@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">لوحة التحكم</h1>
    <p>مرحبًا {{ auth()->user()->name }}! هذه لوحة التحكم الخاصة بك.</p>
</div>
@endsection
