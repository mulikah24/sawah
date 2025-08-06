<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول المدير</title>
</head>
<body>
    <h2>تسجيل دخول المدير</h2>
    @if($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" required><br>
        <label>كلمة المرور:</label>
        <input type="password" name="password" required><br>
        <button type="submit">دخول</button>
    </form>
</body>
</html>
