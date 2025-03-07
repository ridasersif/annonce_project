<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\offer;
use App\Http\Requests\StoreofferRequest;
use App\Http\Requests\UpdateofferRequest;

class OfferController extends Controller
{

    public function index()
    {
        $offers = offer::where('status', 'active')->paginate(6);
        return view('offers.index', compact('offers'));
    }

    public function store(StoreofferRequest $request)
    {
        $user = Auth::user();
        offer::create([
        'society_id' => $user->society->id,   
        'title' => $request->title,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'price' => $request->price,
        'capacity' => $request->capacity,
        'status' => $request->status,
        ]);
        return redirect()->route('society.dashboard.offer');
    }

    public function update(UpdateofferRequest $request, offer $offer)
    {
        $validated = $request->validated();
       $offer->update($validated);
        return redirect()->route('society.dashboard.offer');
    }
   
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return redirect()->route('society.dashboard.offer')->with('success', 'Offer deleted successfully');
    }
    
}
