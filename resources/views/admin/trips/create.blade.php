@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">إضافة رحلة جديدة</h1>

    <form action="{{ route('admin.trips.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-semibold">اسم الرحلة</label>
            <input type="text" name="name" id="name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="location" class="block font-semibold">الموقع</label>
            <textarea name="location" id="location" class="w-full border rounded p-2" rows="4"></textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block font-semibold">السعر (بالريال)</label>
            <input type="number" name="price" id="price" class="w-full border rounded p-2" step="0.01" required>
        </div>

        <div class="mb-4">
            <label for="date" class="block font-semibold">تاريخ الرحلة</label>
            <input type="date" name="date" id="date" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">حفظ الرحلة</button>
    </form>
</div>
@endsection