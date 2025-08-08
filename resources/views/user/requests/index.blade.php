@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">طلباتي</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($requests->isEmpty())
        <p class="text-gray-600">لا توجد طلبات حالياً.</p>
    @else
        <div class="space-y-6">
            @foreach($requests as $request)
                <div class="border p-4 rounded shadow-sm">
                    <h2 class="text-xl font-semibold mb-2">{{ $request->trip->name ?? 'رحلة غير متوفرة' }}</h2>

                    <p><strong>الاسم:</strong> {{ $request->name }}</p>
                    <p><strong>البريد الإلكتروني:</strong> {{ $request->email }}</p>
                    <p><strong>رقم الجوال:</strong> {{ $request->phone}}</p>
                    <p><strong>ملاحظات:</strong> {{ $request->notes ?? 'لا توجد' }}</p>
                    <p><strong>تاريخ الطلب:</strong> {{ $request->created_at->format('Y-m-d') }}</p>

                    <form action="{{ route('user.requests.delete', $request->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا الطلب؟');" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            حذف الطلب
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
