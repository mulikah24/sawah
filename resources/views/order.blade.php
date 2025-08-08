@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8 mt-12">

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-5 py-4 rounded mb-6 text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">طلب رحلة جديدة</h2>

    <form id="tripRequestForm" method="POST" action="{{ route('order.submit') }}">
        @csrf

        <!-- اختيار الرحلة -->
        <div>
            <label for="trip_id" class="block mb-2 text-gray-700 font-semibold text-lg">اختر الرحلة:</label>
            <select name="trip_id" id="trip_id" required
                class="w-full border border-gray-300 rounded-md px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="" disabled selected>-- اختر الرحلة --</option>
                @foreach ($trips as $trip)
                    <option value="{{ $trip->id }}">
                        {{ $trip->name }} - {{ $trip->location }} - السعر: {{ $trip->price }} ريال
                    </option>
                @endforeach
            </select>
            @error('trip_id')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- رقم الجوال -->
        <div>
            <label for="phone" class="block mb-2 text-gray-700 font-semibold text-lg">رقم الجوال:</label>
            <input type="text" name="phone" id="phone" required
                class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="أدخل رقم الجوال">
            @error('phone')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- ملاحظات -->
        <div>
            <label for="notes" class="block mb-2 text-gray-700 font-semibold text-lg">ملاحظات (اختياري):</label>
            <textarea name="notes" id="notes" rows="4" placeholder="أي تفاصيل إضافية..."
                class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            @error('notes')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- زر الإرسال -->
        <div class="text-center">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-md transition duration-200">
                إرسال الطلب
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // تحديث رابط الإرسال حسب الرحلة المختارة
    document.getElementById('tripRequestForm').addEventListener('submit', function(e) {
        const tripId = document.getElementById('trip_id').value;
        if (!tripId) {
            e.preventDefault();
            alert("الرجاء اختيار رحلة أولاً.");
            return;
        }

        // استبدال /0/ بـ ID الرحلة المختارة
        this.action = this.action.replace('/0/', '/' + tripId + '/');
    });
</script>
@endsection