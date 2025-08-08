<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function index()
    {
        $recommendations = recommendation::all();
        $isAdmin = auth()->user() && auth()->user()->hasRole('admin');
        return view($isAdmin ? 'admin.recommendations.index' : 'recommendations.index', compact('recommendations'));
    }

    public function create()
    {
        return view('recommendations.create');
    }

    public function destroy($id)
    {
        $recommendation = Recommendation::findOrFail($id);
        $recommendation->delete();

        return redirect()->route('admin.recommendations.index')->with('success', 'تم حذف التوصية بنجاح.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Recommendation::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('recommendations.index')->with('success', 'تمت إضافة التوصية بنجاح');
    }
}