<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qutation extends Model
{
    use HasFactory;
    protected $fillable=[
    'user_id',
    'requests_id',
    'Taxes',
    'Delivery',
    ];

    function getrequest(){
        return $this->BelongsTo(Requeest::class, 'requests_id', 'id')->with('Product_Request','getuser','getsupplier','getclient');
     }
     
     function getuser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
     }
}
