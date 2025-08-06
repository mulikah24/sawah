@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">طلب رحلة جديدة</h2>

    <form action="{{ route('order.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- اختيار الرحلة -->
        <div>
            <label for="trip_id" class="block mb-1 text-gray-700 font-medium">اختر الرحلة:</label>
            <select name="trip_id" id="trip_id" required class="w-full border border-gray-300 rounded px-3 py-2">
                @foreach ($trips as $trip)
                    <option value="{{ $trip->id }}">{{ $trip->name }} - {{ $trip->price }} ريال</option>
                @endforeach
            </select>
        </div>

        <!-- عدد الأشخاص -->
        <div>
            <label for="people_count" class="block mb-1 text-gray-700 font-medium">عدد الأشخاص:</label>
            <input type="number" name="people_count" id="people_count" min="1" required
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <!-- ملاحظات -->
        <div>
            <label for="notes" class="block mb-1 text-gray-700 font-medium">ملاحظات (اختياري):</label>
            <textarea name="notes" id="notes" rows="4"
                class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
        </div>

        <!-- زر الإرسال -->
        <div class="text-center">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded">
                إرسال الطلب
            </button>
        </div>
    </form>
</div>
@endsection