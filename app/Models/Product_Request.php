<?php

namespace App\Models;

use App\Models\Admin\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Request extends Model
{
    use HasFactory;
    protected $table   = "product_request";
    protected $fillable=[
                'productid',
                'request_id',
                'productdescription',
                'quantity',
    ];
 
     function getuser(){
      return $this->BelongsTo(User::class, 'user_id', 'id');
   }
     function getproduct(){
       return $this->BelongsTo(product::class, 'productid', 'id');
    }
}
