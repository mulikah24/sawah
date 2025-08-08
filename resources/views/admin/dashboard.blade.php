@extends('layouts.admin')

@section('content')
<div class="p-6 bg-amber-100 min-h-screen font-sans text-amber-900">
    <h1 class="text-4xl font-extrabold mb-8 text-center">لوحة تحكم المدير</h1>

    <!-- إحصائيات -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-amber-200 shadow-md rounded-2xl p-6 border border-amber-300">
            <h2 class="text-lg font-semibold mb-2 text-amber-800">عدد الرحلات</h2>
            <p class="text-5xl font-bold text-amber-900">{{ $tripCount }}</p>
        </div>
        <div class="bg-amber-200 shadow-md rounded-2xl p-6 border border-amber-300">
            <h2 class="text-lg font-semibold mb-2 text-amber-800">عدد الأعضاء</h2>
            <p class="text-5xl font-bold text-amber-900">{{ $memberCount }}</p>
        </div>
        <div class="bg-amber-200 shadow-md rounded-2xl p-6 border border-amber-300">
            <h2 class="text-lg font-semibold mb-2 text-amber-800">عدد الطلبات</h2>
            <p class="text-5xl font-bold text-amber-900">{{ $requestCount }}</p>
        </div>
    </div>

    <!-- آخر الرحلات -->
    <div class="bg-amber-50 shadow-md rounded-2xl p-6 mb-10 border border-amber-300">
        <h2 class="text-2xl font-bold mb-4">أحدث الرحلات</h2>
        <table class="w-full table-auto border border-amber-300 text-right">
            <thead>
                <tr class="bg-amber-200">
                    <th class="p-3 border-b border-amber-300">العنوان</th>
                    <th class="p-3 border-b border-amber-300">السعر</th>
                    <th class="p-3 border-b border-amber-300">التاريخ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trips as $trip)
                <tr class="border-b border-amber-300 hover:bg-amber-100">
                    <td class="p-3">{{ $trip->name }}</td>
                    <td class="p-3">{{ $trip->price }} ر.س</td>
                    <td class="p-3">{{ $trip->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- روابط سريعة -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.trips.index') }}" class="bg-amber-400 hover:bg-amber-500 text-amber-900 font-semibold p-4 rounded-2xl text-center transition">إدارة الرحلات</a>
        <a href="{{ route('admin.requests.index') }}" class="bg-amber-400 hover:bg-amber-500 text-amber-900 font-semibold p-4 rounded-2xl text-center transition">عرض الطلبات</a>
        <a href="{{ route('admin.recommendations.index') }}" class="bg-amber-400 hover:bg-amber-500 text-amber-900 font-semibold p-4 rounded-2xl text-center transition">التوصيات</a>
        <a href="{{ route('admin.contacts.index') }}" class="bg-amber-400 hover:bg-amber-500 text-amber-900 font-semibold p-4 rounded-2xl text-center transition">الرسائل الواردة</a>
    </div>
</div>
@endsection