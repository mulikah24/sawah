<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\RequestTrip;
use App\Models\Trip;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $trips = Trip::all();
        return view('order', compact('trips'));
    }
    // عرض نموذج طلب رحلة مستقل
    public function createRequestTripForm()
    {
        $trips = Trip::all();
        return view('order.request-trip', compact('trips'));
    }

    // حفظ الطلب في نفس جدول request_trips
    public function storeRequestTrip(Request $request, $id = null)
    {
        $tripId = $id ?? $request->input('trip_id');
        $request->validate([
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        $trip = Trip::findOrFail($tripId);

        RequestTrip::create([
            'user_id' => auth()->id(),
            'trip_id' => $trip->id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => $request->phone,
            'notes' => $request->notes,
        ]);

        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.requests.index')->with('success', 'تم إرسال الطلب بنجاح!');
        } else {
            return redirect()->route('user.requests')->with('success', 'تم إرسال الطلب بنجاح!');
        }
    }
}