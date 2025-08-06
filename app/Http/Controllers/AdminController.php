<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\RequestTrip;
use App\Models\Recommendation;

class AdminController extends Controller
{
    // ✅ لوحة تحكم المدير
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // ✅ إدارة الطلبات
    public function showRequests()
    {
        $requests = RequestTrip::all();
        return view('trip-request', compact('requests')); // الملف خارج المجلدات
    }

    public function deleteRequest($id)
    {
        $request = RequestTrip::findOrFail($id);
        $request->delete();
        return redirect()->route('admin.requests')->with('success', 'تم حذف الطلب بنجاح');
    }

    // ✅ إدارة الرحلات
    public function manageTrips()
    {
        $trips = Trip::all();
        return view('trips.index', compact('trips')); // داخل مجلد trips
    }

    public function createTrip()
    {
        return view('trips.contact'); // صفحة إنشاء رحلة داخل trips/contact
    }

    public function storeTrip(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Trip::create($request->all());

        return redirect()->route('admin.trips.index')->with('success', 'تم إضافة الرحلة بنجاح');
    }

    public function editTrip($id)
    {
        $trip = Trip::findOrFail($id);
        return view('trips.contact', compact('trip')); // يعرض نفس النموذج مع البيانات
    }

    public function updateTrip(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);
        $trip->update($request->all());

        return redirect()->route('admin.trips.index')->with('success', 'تم تحديث الرحلة بنجاح');
    }

    public function deleteTrip($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return redirect()->route('admin.trips.index')->with('success', 'تم حذف الرحلة بنجاح');
    }

    // ✅ إدارة التوصيات
    public function showRecommendations()
    {
        $recommendations = Recommendation::all();
        return view('recommendations', compact('recommendations')); // الملف خارج المجلدات
    }

    public function storeRecommendation(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:1000',
            'author' => 'nullable|string|max:255',
        ]);

        Recommendation::create($request->all());

        return redirect()->route('admin.recommendations')->with('success', 'تم إضافة التوصية بنجاح');
    }

    // ✅ صفحة تسجيل الدخول الخاصة بالمدير
    public function showLoginForm()
    {
        return view('admin.login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                auth()->logout();
                return redirect()->route('admin.login')->withErrors(['email' => 'أنت لست مديراً']);
            }
        }

        return redirect()->route('admin.login')->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
    }
}