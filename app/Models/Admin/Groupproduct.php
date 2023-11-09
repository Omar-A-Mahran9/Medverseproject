<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupproduct extends Model
{
    use HasFactory;
    function producct(){
        return $this->hasMany(product::class, 'group', 'id');
     }
}
