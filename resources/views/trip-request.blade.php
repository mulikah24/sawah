@extends('layouts.app')

@section('title', 'طلب رحلة')

@section('content')
<h1>طلب رحلة: {{ $trip->destination }}</h1>

<form action="{{ route('trip.submit', $trip->id) }}" method="POST" class="space-y-4">
    @csrf
    <label>الاسم:</label><br>
    <input type="text" name="name" required class="w-full p-2 border rounded"><br>

    <label>البريد الإلكتروني:</label><br>
    <input type="email" name="email" required class="w-full p-2 border rounded"><br>

    <label>رقم الجوال:</label><br>
    <input type="text" name="phone" required class="w-full p-2 border rounded"><br>

    <label>ملاحظات:</label><br>
    <textarea name="message" class="w-full p-2 border rounded"></textarea><br>

    <button type="submit" class="btn">إرسال الطلب</button>
</form>
@endsection
