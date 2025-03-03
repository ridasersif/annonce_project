<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\offer;
use App\Http\Requests\StoreofferRequest;
use App\Http\Requests\UpdateofferRequest;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function index()
    // {
    //     $offers = offer::all();
    //     return view('offers.index', compact('offers'));
    // }

    /**
     * Show the form for creating a new resource.
     */
  

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(offer $offer)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateofferRequest $request, offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return redirect()->route('society.dashboard.offer')->with('success', 'Offer deleted successfully');
    }
    
}
