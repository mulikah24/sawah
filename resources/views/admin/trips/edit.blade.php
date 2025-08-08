@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">تعديل الرحلة</h1>

    {{-- رسالة نجاح --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- نموذج التعديل --}}
    <form action="{{ route('admin.trips.update', $trip->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">اسم الرحلة</label>
            <input type="text" name="name" value="{{ $trip->name }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">الموقع</label>
            <input type="text" name="location" value="{{ $trip->location }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">السعر</label>
            <input type="number" name="price" value="{{ $trip->price }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">تاريخ الرحلة</label>
            <input type="date" name="date" value="{{ $trip->date }}" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            حفظ التعديلات
        </button>
    </form>
</div>
@endsection