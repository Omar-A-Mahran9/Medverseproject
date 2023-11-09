<?php

namespace App\Models\Admin;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
'productname',
'productcode',
    'group',
   'Qty',
   'price'
    ];
    public function clinics()
    {
        return $this->belongsToMany(Clinic::class);
    }
    function getgroup(){
        return $this->BelongsTo(Groupproduct::class, 'group', 'id');
     }
}
 
    
  