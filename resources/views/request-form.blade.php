@extends('layouts.app')

@section('content')
<div class="container">
    <h2>نموذج طلب الرحلة: {{ $trip->destination }}</h2>
    <form method="POST" action="{{ url('/submit-request') }}">
        @csrf
        <input type="hidden" name="trip_id" value="{{ $trip->id }}">

        <div class="form-group">
            <label>الاسم:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>البريد الإلكتروني:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>ملاحظات:</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">إرسال الطلب</button>
    </form>
</div>
@endsection

