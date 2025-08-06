<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\RequestTrip;
use Illuminate\Http\Request;

class RequestTripController extends Controller
{
    public function showForm($id)
    {
        $trip = Trip::findOrFail($id);
        return view('request-form', compact('trip'));
    }

    public function index(){
        return view('trip-request.index');
    }
    

    public function submit(Request $request)
    {
        RequestTrip::create([
            'trip_id' => $request->trip_id,
            'name' => $request->name,
            'email' => $request->email,
            'notes' => $request->notes,
        ]);

        return redirect('/')->with('success', 'تم إرسال طلبك بنجاح!');
    }
}

