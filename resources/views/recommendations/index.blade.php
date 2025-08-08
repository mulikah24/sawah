@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">التوصيات</h1>

    @auth
        <div class="mb-4">
            <a href="{{ route('recommendations.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
               أضف توصية جديدة
            </a>
        </div>
    @else
        <p class="mb-4 text-gray-600">
            إذا أردت إضافة توصية، الرجاء <a href="{{ route('login') }}" class="text-blue-600 underline">تسجيل الدخول</a>.
        </p>
    @endauth

    @if($recommendations->isEmpty())
        <p class="text-gray-500">لا توجد توصيات حالياً.</p>
    @else
        <ul class="space-y-4">
            @foreach($recommendations as $recommendation)
                <li class="bg-white p-4 rounded shadow">
                    <h2 class="text-lg font-semibold">{{ $recommendation->title }}</h2>
                    <p class="text-gray-700">{{ $recommendation->content }}</p>
                    <p class="text-sm text-gray-500 mt-2">بواسطة: {{ $recommendation->user->name }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

