@extends('layouts.app')

@section('content')
    

    @if($trips->count())
        <ul>
            @foreach($trips as $trip)
                <li>
                    <strong>{{ $trip->title }}</strong> — {{ $trip->description }} — السعر: {{ $trip->price }} ريال
                    <a href="{{ route('trip.details', $trip->id) }}">تفاصيل</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>لا توجد رحلات متاحة حالياً.</p>
    @endif
@endsection