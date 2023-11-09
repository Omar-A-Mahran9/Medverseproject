<?php

namespace App\Models;
use App\Models\Admin\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicInventory extends Model
{
    use HasFactory;
 
    protected $fillable = [
        
        'product_id',
        'clinic_id',
        'userinventory_id',
        'Quantity',
    ];

    public function getproduct(){
        return $this->BelongsTo(product::class, 'product_id', 'id');
    } 
}
