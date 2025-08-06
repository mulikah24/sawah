<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Trip;  
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // صفحة إنشاء الطلب مع عرض الرحلات
    public function create()
    {
        $trips = Trip::all();  // جلب جميع الرحلات من قاعدة البيانات
        return view('order.create', compact('trips'));
    }

    // صفحة الطلب (يمكن تستخدمها للعرض العام)
    public function index()
    {
        $trips = Trip::all();
        return view('order',compact('trips'));
    }

    // حفظ الطلب في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'trip_name' => 'required|string|max:255',
            'trip_price' => 'required|numeric',
        ]);

        Order::create($request->all());

        return redirect('/')->with('success', 'تم إرسال الطلب بنجاح!');
    }
}