@extends('layouts.app')

@section('content')
    <div class="text-center mt-16">
        <h1 class="text-4xl font-bold text-blue-800">مرحبًا بك في سَوّاح 🧳</h1>
        <p class="text-xl mt-4">استكشف أجمل الرحلات حول العالم واحجز رحلتك بسهولة.</p>
        
        <a href="{{ route('trips.index')}}" class="inline-block bg-blue-800 text-white px-6 py-2 rounded-lg mt-6 hover:bg-blue-900 transition">
            عرض الرحلات
        </a>

        @auth
            @if(auth()->user()->hasRole('admin'))
                <div class="mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-700 underline">لوحة تحكم المدير</a>
                </div>
            @elseif(auth()->user()->hasRole('user'))
                <div class="mt-4">
                    <a href="{{ route('user.profile') }}" class="text-sm text-gray-700 underline">صفحتي الشخصية</a>
                </div>
            @endif
        @else
            <div class="mt-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">تسجيل الدخول لحجز الرحلات</a>
            </div>
        @endauth
    </div>

    <div class="container mx-auto px-4 mt-16">
        <h2 class="text-2xl font-semibold text-center mb-6">الرحلات المتاحة</h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($trips as $trip)
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $trip->title }}</h3>
                        <p class="text-gray-600 mt-2">{{ $trip->description }}</p>
                        <p class="mt-2 font-semibold text-blue-800">السعر: {{ $trip->price }} ريال</p>
                    </div>

                    <div class="mt-4">
                        @auth
                            <a href="{{ route('trip.request', $trip->id) }}" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded block text-center">
                                احجز الآن
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-gray-400 text-white px-4 py-2 rounded block text-center cursor-not-allowed">
                                سجل الدخول للحجز
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection