@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">الأماكن السياحية</h2>
    <div class="row">
        @foreach($trips as $trip)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $trip->name }}</h5>
                        <p class="card-text">{{ $trip->description }}</p>
                        <p class="card-text"><strong>السعر:</strong> {{ $trip->price }} ريال</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
