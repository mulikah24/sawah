@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">إدارة طلبات الرحلات</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($requests->isEmpty())
        <p class="text-gray-600">لا توجد طلبات حالياً.</p>
    @else
        <table class="min-w-full border text-center bg-white">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">اسم المستخدم</th>
                    <th class="border px-4 py-2">اسم الرحلة</th>
                    <th class="border px-4 py-2">ملاحظات</th>
                    <th class="border px-4 py-2">تاريخ الإرسال</th>
                    <th class="border px-4 py-2">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                <tr>
                    <td class="border px-4 py-2">{{ $request->id }}</td>
                    <td class="border px-4 py-2">{{ $request->user->name ?? '---' }}</td>
                    <td class="border px-4 py-2">{{ $request->trip->name ?? '---' }}</td>
                    <td class="border px-4 py-2">{{ $request->notes ?? '---' }}</td>
                    <td class="border px-4 py-2">{{ $request->created_at->format('Y-m-d') }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('admin.requests.delete', $request->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطلب؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection