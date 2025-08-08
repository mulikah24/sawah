@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">طلب رحلة</h1>

        <form method="POST" action="{{ route('trip.submit',$trip->id) }}">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1">الاسم:</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ auth()->user()->name }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">البريد الإلكتروني:</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ auth()->user()->email }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">رقم الجوال:</label>
                <input type="text" name="phone" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">ملاحظات:</label>
                <textarea name="notes" class="w-full border px-3 py-2 rounded"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">إرسال الطلب</button>
        </form>
    </div>
@endsection
