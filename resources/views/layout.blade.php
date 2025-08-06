<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'رحلات سياحية')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- يمكنك تعديل المسار لاحقاً --}}
</head>
<body>
    <header>
        <h1>موقع السياحة</h1>
        <nav>
            <a href="{{ route('home') }}">الرئيسية</a> |
            <a href="{{ route('contact') }}">اتصل بنا</a> |
            <a href="{{ route('admin.dashboard') }}">الإدارة</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>جميع الحقوق محفوظة &copy; {{ date('Y') }}</p>
    </footer>
</body>
</html>
