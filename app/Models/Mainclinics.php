<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mainclinics extends Model
{
    use HasFactory;
    protected $fillable=[
        'hosbitalneme',
        'user_id',
        
    ];

    function user(){
        return $this->BelongsTo(User::class, 'user_id', 'id');
     }
}
