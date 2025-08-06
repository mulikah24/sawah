@extends('layouts.app')

@section('content')
    <h2>لوحة التحكم</h2>

    @auth
        @if(Auth::user()->role === 'admin')
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">إدارة الأعضاء</h5>
                            <p class="card-text">تحكم بالأعضاء وتابع نشاطاتهم.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title">إدارة الرحلات</h5>
                            <p class="card-text">أضف وعدل تفاصيل الرحلات.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">التقييمات</h5>
                            <p class="card-text">راقب تقييمات المستخدمين.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">الإعدادات</h5>
                            <p class="card-text">تعديل إعدادات الموقع العامة.</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info mt-4">
                مرحبًا {{ Auth::user()->name }}! ليس لديك صلاحية للوصول إلى لوحة التحكم الكاملة.
            </div>
        @endif
    @endauth
@endsection
