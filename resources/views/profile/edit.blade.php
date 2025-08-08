@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12 max-w-3xl">
    <h1 class="text-2xl font-semibold mb-6">تعديل الحساب</h1>

    {{-- رسالة نجاح تحديث البيانات --}}
    @if(session('status') === 'profile-updated')
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            تم تحديث بيانات الحساب بنجاح.
        </div>
    @endif

    {{-- رسالة نجاح تحديث كلمة المرور --}}
    @if(session('status') === 'password-updated')
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            تم تحديث كلمة المرور بنجاح.
        </div>
    @endif

    {{-- رسالة خطأ الحذف --}}
    @error('password')
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ $message }}
        </div>
    @enderror

    {{-- نموذج تعديل الاسم والبريد --}}
    <form method="POST" action="{{ route('profile.update') }}" class="mb-8">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">الاسم</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-300"
            />
            @error('name')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">البريد الإلكتروني</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-300"
            />
            @error('email')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            حفظ التغييرات
        </button>
    </form>

    {{-- نموذج تغيير كلمة المرور --}}
    <form method="POST" action="{{ route('password.update') }}" class="mb-8">
        @csrf
        @method('PUT')

        <h2 class="text-xl font-semibold mb-4">تغيير كلمة المرور</h2>

        <div class="mb-4">
            <label for="current_password" class="block text-gray-700 font-medium mb-2">كلمة المرور الحالية</label>
            <input
                type="password"
                id="current_password"
                name="current_password"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-300"
            />
            @error('current_password')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">كلمة المرور الجديدة</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-300"
            />
            @error('password')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">تأكيد كلمة المرور الجديدة</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-300"
            />
            @error('password_confirmation')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            تغيير كلمة المرور
        </button>
    </form>

    {{-- نموذج حذف الحساب --}}
    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')

        <h2 class="text-xl font-semibold mb-4 text-red-600">حذف الحساب</h2>

        <p class="mb-4 text-gray-700">
            عند حذف الحساب، سيتم حذف جميع بياناتك نهائياً. لا يمكن التراجع عن هذا الإجراء.
        </p>

        <div class="mb-4">
            <label for="password_delete" class="block text-gray-700 font-medium mb-2">أدخل كلمة المرور لتأكيد الحذف</label>
            <input
                type="password"
                id="password_delete"
                name="password"
                required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-red-500"
            />
            @error('password')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition"
            onclick="return confirm('هل أنت متأكد من حذف الحساب؟ هذا لا يمكن التراجع عنه!')"
        >
            حذف الحساب
        </button>
    </form>
</div>
@endsection