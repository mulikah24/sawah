@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">أضف توصية جديدة</h1>

    <form method="POST" action="{{ route('suggestions.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-2 font-medium text-gray-700">عنوان التوصية</label>
            <input type="text" name="title" class="w-full border border-gray-300 px-4 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium text-gray-700">محتوى التوصية</label>
            <textarea name="content" class="w-full border border-gray-300 px-4 py-2 rounded" rows="4" required></textarea>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            حفظ التوصية
        </button>

        <a href="{{ route('suggestions.index') }}"
           class="ml-4 text-gray-600 hover:underline">
           الرجوع للتوصيات
        </a>
    </form>
</div>
@endsection
