@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">طلباتي</h2>

    @if($requests->isEmpty())
        <div class="alert alert-info">لا توجد طلبات حتى الآن.</div>
    @else
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>الوجهة</th>
                    <th>التاريخ</th>
                    <th>عدد الأشخاص</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $index => $request)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $request->destination }}</td>
                        <td>{{ $request->date }}</td>
                        <td>{{ $request->num_people }}</td>
                        <td>{{ $request->notes ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
