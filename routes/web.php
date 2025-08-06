<?php

use Illuminate\Support\Facades\Route;
use App\Models\Trip;
use App\Http\Controllers\{
    TripController, OrderController, SuggestionController,
    AdminController, UserController, HomeController, ProfileController,
    UserRequestController
};

// ✅ الصفحة الرئيسية (متاحة للجميع)
Route::get('/', function () {
    $trips = Trip::all();
    return view('welcome', compact('trips'));
})->name('home');

// ✅ صفحة "تواصل معنا" - العرض متاح للجميع، الإرسال يتطلب تسجيل دخول
Route::get('/contact', [TripController::class, 'contact'])->name('contact');
Route::post('/contact', [TripController::class, 'sendContact'])
    ->middleware('auth')
    ->name('contact.send');

// ✅ تفاصيل الرحلة - العرض متاح للجميع
Route::get('/trip/{id}/details', [TripController::class, 'show'])->name('trip.details');

// ✅ عرض جميع الرحلات
Route::get('/trips', [TripController::class, 'index'])->name('trips.index');

// ✅ عرض التوصيات (متاح للجميع)
Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');

// ✅ المسارات التي تتطلب تسجيل دخول
Route::middleware('auth')->group(function () {

    // ✅ إرسال توصية
    Route::get('/suggestions/create', [SuggestionController::class, 'create'])->name('suggestions.create');
    Route::post('/suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');

    // ✅ إرسال طلب رحلة معينة
    Route::get('/trip/{id}/request', [TripController::class, 'showRequestForm'])->name('trip.request');
    Route::post('/trip/{id}/request', [TripController::class, 'submitRequest'])->name('trip.submit');

    // ✅ الطلبات الخاصة بالمستخدم
    Route::get('/user/requests', [App\Http\Controllers\UserRequestController::class, 'index'])->name('user.requests');

    // ✅ إرسال طلب عام (غير مرتبط برحلة معينة)
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

    // ✅ الحساب الشخصي (خاص بالمستخدم العادي فقط)
    Route::get('/profile', [UserController::class, 'profile'])
        ->middleware(['role:user'])
        ->name('user.profile');

    // ✅ لوحة تحكم المسؤول (خاص بالمدير فقط)
    Route::prefix('admin')->middleware(['role:admin'])->name('admin.')->group(function () {

        // لوحة تحكم المدير
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // إدارة الرحلات (CRUD بدون show)
        Route::resource('trips', AdminController::class)->except(['show']);

        // إدارة الطلبات
        Route::get('/requests', [AdminController::class, 'showRequests'])->name('requests');
        Route::delete('/requests/{id}', [AdminController::class, 'deleteRequest'])->name('requests.delete');

        // إدارة التوصيات
        Route::get('/recommendations', [AdminController::class, 'showRecommendations'])->name('recommendations');
        Route::post('/recommendations', [AdminController::class, 'storeRecommendation'])->name('recommendations.store');
    });
});

// ✅ لوحة التحكم الافتراضية بعد تسجيل الدخول (لجميع الأدوار)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// ✅ Laravel Breeze Auth Routes
require __DIR__.'/auth.php';