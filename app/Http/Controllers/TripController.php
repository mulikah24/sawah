<?php

namespace App\Http\Controllers;
use App\Models\RequestTrip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Contact;

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

    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        return view('trips.show', compact('trip'));
    }

    public function index()
    {
        $trips = Trip::all();
        return view('trips.index', compact('trips'));
    }

    public function showRequestForm($id)
    {
        $trip = Trip::findOrFail($id);
        return view('request-form', compact('trip'));
    }

    public function submitRequest(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);

        RequestTrip::create([
            'user_id' => Auth::id(),
            'trip_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'notes' => $request->notes
        ]);



        return redirect()->route('home')->with('success', 'تم إرسال طلب الرحلة بنجاح!');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'تم إرسال رسالتك بنجاح!');
    }
}

