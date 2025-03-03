<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /** @use HasFactory<\Database\Factories\OfferFactory> */
    use HasFactory;
    protected $fillable = [
        'society_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'price',
        'capacity',
        'status'
    ];
    public function society()
    {
        return $this->belongsTo(Society::class);
    }
    // public function reservations()
    // {
    //     return $this->hasMany(Reservation::class);
    // }

}
