<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'company_name', 'address', 'description'];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }    
}
