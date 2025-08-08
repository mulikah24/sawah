<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\RequestTrip;
use App\Models\Recommendation;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;


class AdminController extends Controller
{

    public function index(){
        $orders = order::latest()->get();
        return view('admin.requests.index',compact('orders'));
    }
    // لوحة تحكم المدير
    public function dashboard()
    {
        $tripCount = Trip::count();
        $memberCount = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->count();
        $requestCount = RequestTrip::count();
        $trips = Trip::latest()->take(5)->get();

        return view('admin.dashboard', compact('tripCount', 'memberCount', 'requestCount', 'trips'));
    }
    public function viewRequests()
    {
        $orders = \App\Models\Order::latest()->get();
        return view('admin.requests', compact('orders'));
    }

    // إدارة الرحلات - عرض كل الرحلات
    public function manageTrips()
    {
        $trips = Trip::all();
        return view('admin.trips.index', compact('trips'));
    }

    // صفحة إنشاء رحلة جديدة
    public function createTrip()
    {
        return view('admin.trips.create');
    }

    // تخزين رحلة جديدة
    public function storeTrip(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Trip::create($request->only(['name', 'location', 'price', 'date']));

        return redirect()->route('admin.trips.index')->with('success', 'تم إضافة الرحلة بنجاح');
    }

    // تعديل رحلة - عرض نموذج التعديل
    public function editTrip($id)
    {
        $trip = Trip::findOrFail($id);
        return view('admin.trips.edit', compact('trip'));
    }

    // تحديث رحلة
    public function updateTrip(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $trip->update($request->only(['name', 'location', 'price', 'date']));

        return redirect()->route('admin.trips.index')->with('success', 'تم تحديث الرحلة بنجاح');
    }

    // حذف رحلة
    public function destroy(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);

    // إذا فيه طلبات مرتبطة بالرحلة
        if ($trip->requests()->exists()) {
        // إذا ما فيه تأكيد بالحذف
            if (!$request->has('confirm_delete')) {
                return back()->with('confirm_delete', true)->with('trip_id', $id);
            }

        // حذف الطلبات المرتبطة أولًا
            $trip->requests()->delete();
        }

    // حذف الرحلة نفسها
        $trip->delete();

        return redirect()->route('admin.trips.index')->with('success', 'تم حذف الرحلة بنجاح.');
    }

    // إدارة الطلبات - عرض الطلبات
    public function showRequests()
    {
        $requests = RequestTrip::with(['trip', 'user'])->get();
        return view('admin.requests.index', compact('requests'));
    }

    // حذف طلب
    public function deleteRequest($id)
    {
        $request = RequestTrip::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.requests.index')->with('success', 'تم حذف الطلب بنجاح');
    }

    public function contactMessages()
    {
        $messages = Contact::latest()->paginate(10);
        return view('admin.contact.index', compact('messages'));
    }

    public function deleteContact($id)
    {
        Contact::findOrFail($id)->delete();
        return back()->with('success', 'تم حذف الرسالة');
    }
}