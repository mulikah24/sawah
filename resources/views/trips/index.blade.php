@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">الرحلات المتاحة</h1>

    @if($trips->isEmpty())
        <p class="text-gray-600">لا توجد رحلات متاحة حالياً.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($trips as $trip)
                <div class="border rounded p-4 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">{{ $trip->name }}</h2>
                    <p><strong>الموقع:</strong> {{ $trip->location }}</p>
                    <p><strong>السعر:</strong> {{ $trip->price }} ريال</p>
                    <p><strong>التاريخ:</strong> {{ $trip->date }}</p>

                    @auth
                        <a href="{{ route('trip.request', $trip->id) }}" 
                           class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            احجز الآن
                        </a>
                    @else
                        <p class="mt-4 text-gray-500">يجب تسجيل الدخول للحجز</p>
                    @endauth
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection