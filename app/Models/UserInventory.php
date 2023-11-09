<?php

namespace App\Models;

use App\Models\Admin\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'Quantity',
    ];

 
     function getproduct(){
        return $this->BelongsTo(product::class, 'product_id', 'id');
     }
 
}
