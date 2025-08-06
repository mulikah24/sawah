<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class TripController extends Controller
{
    public function home()
    {
        $trips = Trip::all();
        return view('home', compact('trips'));
    }
    public function contact()
    {
        $trips = Trip::all();
        return view('contact');
    }

    public function index()
    {
        $trips = Trip::all();
        return view('trips.index', compact('trips'));
    }

    public function showRequestForm($id)
    {
        $trip = Trip::findOrFail($id);
        return view('user.request-form', compact('trip'));
    }

    public function submitRequest(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
        ]);

        // (اختياري) يمكنك هنا حفظ الطلب في جدول الطلبات، أو تنفيذ إجراءات أخرى

        return redirect()->route('home')->with('success', 'تم إرسال طلب الرحلة بنجاح!');
    }
}

