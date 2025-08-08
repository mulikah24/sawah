<?php

use Illuminate\Support\Facades\Route;
use App\Models\Trip;
use App\Http\Controllers\{
    TripController, OrderController, RecommendationController,
    AdminController, UserController, HomeController, ProfileController,
    UserRequestController
};

//  صفحات للزائرين (بدون تسجيل دخول)

// الصفحة الرئيسية (عرض جميع الرحلات)
Route::get('/', function () {
    $trips = Trip::all();
    return view('welcome', compact('trips'));
})->name('home');

// صفحة تواصل معنا (عرض متاح للجميع، الإرسال يتطلب تسجيل دخول)
Route::get('/contact', [TripController::class, 'contact'])->name('contact');
Route::post('/contact', [TripController::class, 'sendContact'])
    ->middleware('auth')
    ->name('contact.send');

// تفاصيل الرحلة (عرض متاح للجميع)
Route::get('/trip/{id}/details', [TripController::class, 'show'])->name('trip.details');

// عرض جميع الرحلات (عرض متاح للجميع)
Route::get('/trips', [TripController::class, 'index'])->name('trips.index');

// عرض التوصيات (عرض متاح للجميع)
Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations.index');


// ⚙ مسارات تتطلب تسجيل دخول (للمستخدم العادي والمدير معًا)
Route::middleware('auth')->group(function () {

    // إرسال توصية (للمستخدم العادي والمدير)
    Route::get('/recommendations/create', [RecommendationController::class, 'create'])->name('recommendations.create');
    Route::post('/recommendations', [RecommendationController::class, 'store'])->name('recommendations.store');

    // إرسال طلب رحلة معينة (للمستخدم العادي والمدير)
    Route::get('/trip/{id}/request', [TripController::class, 'showRequestForm'])->name('trip.request');
    Route::post('/trip/{id}/submit', [OrderController::class, 'storeRequestTrip'])->name('trip.submit');
    // الطلبات الخاصة بالمستخدم العادي فقط
    Route::get('/user/requests', [UserRequestController::class, 'index'])
        ->middleware('role:user')
        ->name('user.requests');
        
    Route::delete('/user/requests/{id}', [UserRequestController::class, 'destroy'])
    ->middleware('role:user')
    ->name('user.requests.delete');
    // إرسال طلب عام (غير مرتبط برحلة معينة)
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::post('/order/submit', [OrderController::class, 'storeRequestTrip'])->name('order.submit');
    // الحساب الشخصي (خاص بالمستخدم العادي فقط)
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->middleware('role:user')
        ->name('user.profile');

    // ✅ تعديل بيانات الحساب (الاسم/البريد)
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // ✅ حذف الحساب
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // ✅ تعديل كلمة المرور
    Route::put('/password', [ProfileController::class, 'updatePassword'])
        ->name('password.update');
});


// 🔐 لوحة تحكم المدير (خاص بالمدير فقط)
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {

    // لوحة التحكم الرئيسية للمدير
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/requests', [AdminController::class, 'index'])->name('admin.requests.index');
    // إدارة الرحلات
    Route::get('/trips', [AdminController::class, 'manageTrips'])->name('trips.index');
    Route::get('/trips/create', [AdminController::class, 'createTrip'])->name('trips.create');
    Route::post('/trips', [AdminController::class, 'storeTrip'])->name('trips.store');
    Route::get('/trips/{id}/edit', [AdminController::class, 'editTrip'])->name('trips.edit');
    Route::put('/trips/{id}', [AdminController::class, 'updateTrip'])->name('trips.update');
    Route::delete('/trips/{id}', [AdminController::class, 'destroy'])->name('trips.destroy');

    // إدارة الطلبات
    Route::get('/requests', [AdminController::class, 'showRequests'])->name('requests.index');
    Route::delete('/requests/{id}', [AdminController::class, 'deleteRequest'])->name('requests.delete');

    // إدارة التوصيات
    Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations.index');
    Route::delete('/recommendations/{id}', [RecommendationController::class, 'destroy'])->name('recommendations.destroy');

    Route::get('/contacts', [AdminController::class, 'contactMessages'])->name('contacts.index');
    Route::delete('/contacts/{id}', [AdminController::class, 'deleteContact'])->name('contacts.destroy');
});


// 🔐 لوحة التحكم الافتراضية بعد تسجيل الدخول (تحويل المدير لصفحة لوحة تحكمه)
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard'); // للمستخدم العادي
})->middleware('auth')->name('dashboard');


// تحميل مسارات المصادقة (login, register, reset...)
require __DIR__.'/auth.php';