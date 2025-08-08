@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-3xl font-bold mb-4">{{ $trip->name }}</h1>

    <div class="mb-4">
        <p><strong>الوصف:</strong> {{ $trip->description }}</p>
        <p><strong>السعر:</strong> {{ $trip->price }} ريال</p>
        <p><strong>الوجهة:</strong> {{ $trip->destination }}</p>
        <p><strong>تاريخ الرحلة:</strong> {{ $trip->date }}</p>
    </div>

    @auth
        <a href="{{ route('trip.request', $trip->id) }}"
           class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            احجز هذه الرحلة
        </a>
    @else
        <p class="text-gray-600">يجب عليك <a href="{{ route('login') }}" class="text-blue-600 underline">تسجيل الدخول</a> لحجز هذه الرحلة.</p>
    @endauth

    <div class="mt-6">
        <a href="{{ route('home') }}" class="text-blue-500 hover:underline">← الرجوع إلى الصفحة الرئيسية</a>
    </div>
</div>
@endsection