@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow mt-10">
    <h1 class="text-2xl font-bold mb-4">تفاصيل الرحلة</h1>

    <div class="space-y-4">
        <p><strong>الاسم:</strong> {{ $trip->name }}</p>
        <p><strong>الموقع:</strong> {{ $trip->location }}</p>
        <p><strong>السعر:</strong> {{ $trip->price }} ريال</p>
        <p><strong>التاريخ:</strong> {{ $trip->date }}</p>
    </div>

    <a href="{{ route('trip.request.form', $trip->id) }}"
       class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        احجز الآن
    </a>
</div>
@endsection