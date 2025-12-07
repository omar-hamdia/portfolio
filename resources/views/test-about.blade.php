<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تجربة عرض About</title>
</head>
<body>

<h1>بيانات الـ About</h1>

{{-- عرض النص --}}
@if($about)
    <h3>المحتوى:</h3>
    <p>{{ $about->content }}</p>

    {{-- عرض الصورة إن وجدت --}}
    @if($about->image)
        <h3>الصورة:</h3>
        <img src="{{ asset('storage/' . $about->image) }}" style="width:250px; border:1px solid #ccc;">
    @else
        <p>لا توجد صورة.</p>
    @endif
@else
    <p>لا توجد بيانات في جدول about.</p>
@endif

</body>
</html>
