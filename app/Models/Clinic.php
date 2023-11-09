<?php

namespace App\Models;

use App\Models\Admin\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinicname',
        'clinicpric',
       'mainclinic_id',
            'user_id',
            'statue',
            'order_id',

     
            ];
            function userorder(){
                return $this->BelongsTo(Order::class, 'order_id', 'id');
             }
             public function products()
             {
                 return $this->belongsToMany(product::class);
             }
}
