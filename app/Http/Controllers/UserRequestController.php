<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestTrip;

class UserRequestController extends Controller
{

    public function destroy($id)
    {
        $request = RequestTrip::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $request->delete();

        return redirect()->route('user.requests')->with('success', 'تم حذف الطلب بنجاح.');
    }
    public function index()
    {
    // يرجّع طلبات المستخدم المسجّل
    $userId = auth()->id();
    $requests = \App\Models\RequestTrip::where('user_id', $userId)->with('trip')->get();
    return view('user.requests.index', compact('requests'));
    }
}
