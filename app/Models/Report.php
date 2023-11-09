<?php

namespace App\Models;

use App\Models\Admin\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'clinic_id',
        'mainQty',
        'subQty',
        'requestQty',
    ];

    function getproduct(){
        return $this->BelongsTo(product::class, 'product_id', 'id');
     }
     function getinventoryproduct(){
        return $this->BelongsTo(UserInventory::class, 'product_id', 'product_id');
     }
}
