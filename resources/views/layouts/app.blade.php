<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>سواح - @yield('title', 'الرئيسية')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* تحكم في ظهور الشريط الجانبي */
        #sidebar-toggle:checked ~ .sidebar {
            transform: translateX(0);
        }
        .sidebar {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-amber-50 text-amber-900 font-sans h-screen flex flex-col md:flex-row">

    <!-- ✅ زر فتح القائمة -->
    <input type="checkbox" id="sidebar-toggle" class="hidden peer">
    <label for="sidebar-toggle"
           class="fixed top-4 right-4 z-50 bg-amber-300 text-amber-900 p-2 rounded shadow-md cursor-pointer peer-checked:hidden">
        ☰ القائمة
    </label>

    <!-- ✅ الشريط الجانبي -->
    <aside class="sidebar w-64 bg-amber-200 p-4 space-y-4 flex-shrink-0 md:static md:h-auto md:z-auto fixed h-full z-50 overflow-y-auto top-0 right-0">

        <!-- ✅ عنوان "سواح" مع زر ✖ داخل الشريط -->
        <div class="flex items-center justify-between text-2xl font-bold border-b border-amber-300 pb-2 mt-12 md:mt-0">
            <a href="{{ route('home') }}" class="hover:text-amber-800">سَوّاح</a>

            <!-- زر ✖ لإغلاق الشريط -->
            <button onclick="document.getElementById('sidebar-toggle').click()"
                    type="button"
                    class="bg-amber-300 text-amber-900 p-1 rounded cursor-pointer hover:bg-amber-400 transition">
                ✖
            </button>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded hover:bg-amber-300">الصفحة الرئيسية</a>

            @auth
                @if(auth()->user()->role === 'user')
                    <a href="{{ route('order') }}" class="block px-3 py-2 rounded hover:bg-amber-300">طلب رحلة</a>
                    <a href="{{ route('user.requests') }}" class="block px-3 py-2 rounded hover:bg-amber-300">طلبات الرحلات</a>
                    <a href="{{ route('recommendations.create') }}" class="block px-3 py-2 rounded hover:bg-amber-300">التوصيات والمقترحات</a>
                    <a href="{{ route('contact') }}" class="block px-3 py-2 rounded hover:bg-amber-300">تواصل معنا</a>
                    <a href="{{ route('user.profile') }}" class="block px-3 py-2 rounded hover:bg-amber-300">حسابي الشخصي</a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-amber-300">لوحة التحكم</a>
                    <a href="{{ route('admin.trips.index') }}" class="block px-3 py-2 rounded hover:bg-amber-300">إدارة الرحلات</a>
                    <a href="{{ route('admin.requests.index') }}" class="block px-3 py-2 rounded hover:bg-amber-300">إدارة الطلبات</a>
                    <a href="{{ route('admin.recommendations.index') }}" class="block px-3 py-2 rounded hover:bg-amber-300">إدارة التوصيات والمقترحات</a>
                    <a href="{{ route('admin.contacts.index') }}" class="block px-3 py-2 rounded hover:bg-amber-300">الرسائل الواردة</a>
                @endif
            @else
                <a href="{{ route('recommendations.index') }}" class="block px-3 py-2 rounded hover:bg-amber-300">التوصيات</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded hover:bg-amber-300">تواصل معنا</a>
            @endauth
        </nav>

        <div class="pt-4 border-t border-amber-300">
            @auth
                <div class="mb-2 text-sm">مرحبًا، {{ auth()->user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-amber-400 hover:bg-amber-500 text-amber-900 font-semibold py-2 rounded">
                        تسجيل الخروج
                    </button>
                </form>
            @else
                <div class="flex space-x-2 rtl:space-x-reverse">
                    <a href="{{ route('login') }}" class="w-full bg-amber-400 hover:bg-amber-500 text-center text-amber-900 font-semibold py-2 rounded">تسجيل الدخول</a>
                    <a href="{{ route('register') }}" class="w-full bg-amber-300 hover:bg-amber-400 text-center text-amber-900 font-semibold py-2 rounded">حساب جديد</a>
                </div>
            @endauth
        </div>
    </aside>

    <!-- ✅ المحتوى الرئيسي -->
    <main class="flex-grow p-6 pt-20 overflow-y-auto transition-all duration-300 md:ml-64">
        @yield('content')
    </main>

</body>
</html>