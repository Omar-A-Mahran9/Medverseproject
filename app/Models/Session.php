<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'sessionname',
        'sessionimage',
        'sessionlink',
        'sessiontype',
        'sessionprice'
    ];
    function sessionuser(){
        return $this->BelongsTo(User::class, 'user_id', 'id');
     }
     function sessioncalender(){
        return $this->hasMany(Sessioncalender::class, 'session_id', 'id');
     }
     

}
