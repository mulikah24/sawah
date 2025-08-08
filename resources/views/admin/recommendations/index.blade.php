@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <h1 class="text-2xl font-bold mb-4">إدارة التوصيات والمقترحات</h1>

        {{-- زر إضافة توصية (اختياري) --}}
        <a href="{{ route('recommendations.create') }}"
           class="inline-block mb-6 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
           + إضافة توصية
        </a>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($recommendations->count() > 0)
            @foreach ($recommendations as $recommendation)
                <div class="bg-white p-4 rounded shadow mb-4">
                    <p><strong>العنوان:</strong> {{ $recommendation->title }}</p>
                    <p><strong>المحتوى:</strong> {{ $recommendation->content }}</p>
                    <p><strong>العضو:</strong> {{ $recommendation->user->name ?? 'غير معروف' }}</p>

                    {{-- زر الحذف --}}
                    <form action="{{ route('admin.recommendations.destroy', $recommendation->id) }}" method="POST"
                          onsubmit="return confirm('هل أنت متأكد من حذف هذه التوصية؟');" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            حذف
                        </button>
                    </form>
                </div>
            @endforeach
        @else
            <div class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded">
                لا توجد توصيات حالياً.
            </div>
        @endif
    </div>
@endsection