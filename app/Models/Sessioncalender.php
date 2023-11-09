<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessioncalender extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'session_id',
        'sessioncalender',
 
    ];
    function sessiontimes(){
        return $this->hasMany(Sessiontime::class, 'sessioncalender_id', 'id');
     }
}
