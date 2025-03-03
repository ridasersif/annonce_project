<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocietyController extends Controller
{
    public function index()
    {
        return view('society.dashboard.index');
    }
    public function offerDashboard()
    {
        $user = Auth::user();
        $offers = Offer::where('society_id', $user->society->id)->paginate(6);
         return view('society.dashboard.offers',compact('offers'));
    }
    public function toggleStatus($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->status = $offer->status === 'active' ? 'inactive' : 'active';
        $offer->save();
        return response()->json(['status' => $offer->status]);
    }
}
