{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>لوحة تحكم المدير</h2>
    <p>مرحبًا بك، {{ auth()->user()->name }}</p>
</div>
@endsection


