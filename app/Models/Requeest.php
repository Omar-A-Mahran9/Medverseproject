<?php

namespace App\Models;

use App\Models\Admin\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requeest extends Model
{
    use HasFactory;
    protected $fillable = [
        'productid',
        'productdescription',
            'image',
           'user_id',
           'supplier_id',
           'client_id',
           'quantity',
           'statue',
            ];

             function getsupplier(){
                return $this->BelongsTo(User::class, 'supplier_id', 'id');
             }
             function getuser(){
                return $this->BelongsTo(User::class, 'user_id', 'id');
             }
             function getproduct(){
               return $this->BelongsTo(product::class, 'productid', 'id');
            }
}
