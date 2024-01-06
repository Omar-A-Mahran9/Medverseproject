<?php

namespace App\Models;

use App\Models\Admin\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requeest extends Model
{
    use HasFactory;
    protected $fillable = [
            'user_id',
            'supplier_id',
            'client_id',
            'statue',
            ];

            function Product_Request(){
               return $this->hasMany(Product_Request::class, 'request_id', 'id')->with('getproduct');
            }
    
            function getuser(){
               return $this->belongsTo(User::class, 'user_id', 'id');
            }
            function getsupplier(){
               return $this->belongsTo(User::class, 'supplier_id', 'id');
            }
            function getclient(){
               return $this->belongsTo(User::class, 'client_id', 'id');
            }
}
