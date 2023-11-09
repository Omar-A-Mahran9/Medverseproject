<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'number_of_clincs',
        'total_price',
            'user_id',
            'statue',
    ];
    function userorder(){
        return $this->BelongsTo(User::class, 'user_id', 'id');
     }
function clinics(){
        return $this->hasMany(Clinic::class,'order_id');
    }
}
