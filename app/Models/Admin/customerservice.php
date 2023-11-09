<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerservice extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'comment',
        'user_id'
    ];

    function getuser(){
        return $this->BelongsTo(User::class, 'user_id', 'id');
     }
}
