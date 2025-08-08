@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">إدارة الرحلات</h1>

    {{-- رسالة تأكيد خاصة بالحذف --}}
    @if (session('confirm_delete'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
            ⚠️ هذه الرحلة تحتوي على طلبات. هل أنت متأكد أنك تريد حذفها؟ سيتم حذف كل الطلبات المرتبطة معها.
        </div>
    @endif

    {{-- زر لإضافة رحلة جديدة --}}
    <div class="mb-4">
        <a href="{{ route('admin.trips.create') }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
            + إضافة رحلة جديدة
        </a>
    </div>

    {{-- جدول الرحلات --}}
    @if ($trips->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded shadow">
                <thead>
                    <tr class="bg-gray-100 text-right">
                        <th class="py-2 px-4 border">#</th>
                        <th class="py-2 px-4 border">اسم الرحلة</th>
                        <th class="py-2 px-4 border">الموقع</th>
                        <th class="py-2 px-4 border">السعر</th>
                        <th class="py-2 px-4 border">التاريخ</th>
                        <th class="py-2 px-4 border">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trips as $trip)
                        <tr>
                            <td class="py-2 px-4 border">{{ $trip->id }}</td>
                            <td class="py-2 px-4 border">{{ $trip->name }}</td>
                            <td class="py-2 px-4 border">{{ $trip->location }}</td>
                            <td class="py-2 px-4 border">{{ $trip->price }} ريال</td>
                            <td class="py-2 px-4 border">{{ $trip->date }}</td>
                            <td class="py-2 px-4 border space-x-2">
                                {{-- زر التعديل --}}
                                <a href="{{ route('admin.trips.edit', $trip->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white py-1 px-3 rounded">
                                    تعديل
                                </a>

                                {{-- زر الحذف --}}
                                @if(session('confirm_delete') && session('trip_id') == $trip->id)
                                    <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="confirm_delete" value="1">
                                        <button type="submit" class="bg-red-700 hover:bg-red-800 text-white py-1 px-3 rounded">
                                            تأكيد الحذف
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded">
                                            حذف
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500">لا توجد رحلات حالياً.</p>
    @endif
</div>
@endsection