<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointmen extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'session_id',
        'sessioncalender_id',
        'sessiontime_id',
        'statue',
        'price'
    ];
    function appointmentsession(){
        return $this->BelongsTo(Session::class, 'session_id', 'id');
     }
    function appointmentuser(){
        return $this->BelongsTo(User::class, 'user_id', 'id');
     }
     function appointmentdate(){
        return $this->BelongsTo(Sessioncalender::class, 'sessioncalender_id', 'id');
     }
     function appointmenttime(){
        return $this->BelongsTo(Sessiontime::class, 'sessiontime_id', 'id');
     }
}
