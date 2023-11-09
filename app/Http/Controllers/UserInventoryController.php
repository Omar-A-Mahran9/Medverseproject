<?php

namespace App\Http\Controllers;

use App\Models\Admin\Groupproduct;
use App\Models\Clinic;
use App\Models\ClinicInventory;
use App\Models\Report;
use App\Models\UserInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
         $product=[];
            $userinv=ClinicInventory::where('clinic_id',$id)->latest()->get();
             foreach($userinv as $userproduct ){
 
             $userproduct->getproduct;
               array_push($product, $userproduct);
            }

        return $product;
    }
    public function indexproduct($id){
        $getclinic=Clinic::where('id',$id)->first();
        if(!$getclinic){
            return response()->json(['erroor'=>'Sorry You do not have Permisiion for this clinic']);
        }else{
         if(Auth::user()->id==$getclinic->user_id){

        $alluserproducts= array();
        $allclinicinventory=ClinicInventory::where('clinic_id',$id)->get();
        foreach ($allclinicinventory  as   $item ) {
            $item->getproduct;
             array_push( $alluserproducts,  $item);
        }
        return $alluserproducts;
    }
    else{
        return response()->json(['erroor'=>'Sorry You do not have Permisiion for this clinic']);
    }
}
    }
    public function deleitem($id){
        ClinicInventory::findOrFail($id)->delete();
    }
    public function changequantity($id){
          $prod=ClinicInventory::find($id);
          $reports=[
            'user_id'=>Auth::user()->id,
            'clinic_id'=>$prod->clinic_id,
            'product_id'=>$prod->product_id,
            'requestQty'=>$prod->Quantity-request('quantity'),
            'mainQty'=>$prod->Quantity,
        ];
         $prod->update([
            'Quantity'=>request('quantity'),
              ]);
        $reports= Arr::add($reports, 'subQty',$prod->Quantity);
            Report::create($reports);
              return $prod;
    }

    public function clinicproduct($id){
         $clinicproduct=ClinicInventory::find($id);
        return $clinicproduct;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserInventory $userInventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserInventory $userInventory)
    {
        //
    }

    /**
     * 
     * Update the specified resource in storage.
     */

    public function update(Request $request, UserInventory $userInventory)
    {
        $validate= request()->validate([
            'productname'=>'required',
            'productcode'=>'required',
            'group_id'=>'required',
            'qty'=>'required',
            'clinic'=>'required',
            'product_id'=>'required'
        ]);
        
    if(Auth::user()->role==='USER'){
        $alluserproduct=UserInventory::where('user_id',Auth::user()->id)->get();

        foreach($alluserproduct as $product){
            if($product->id==request('product_id')){

                $productquantity=$product->Quantity;
                $requwstquantity=request('qty');

                if($productquantity<$requwstquantity||$productquantity==0){
                      return response()->json(['erroor'=>'Sorry You do not have enough Quantity from this product']);
                }
                else{
                    $newqty=$productquantity-$requwstquantity;
                    $product->update([
                        'Quantity'=>$newqty
                    ]);
 
                    $reports=[
                        'user_id'=>Auth::user()->id,
                        'product_id'=>$product->getproduct->id,
                        'requestQty'=>request('qty'),
                        'mainQty'=>$productquantity,
                        'subQty'=>$newqty,
                    ];
                    Report::create($reports);

                    $product->getproduct;
                      $data=[
                        'userinventory_id'=>request('product_id'),
                        'product_id'=>$product->getproduct->id,
                        'Quantity'=>request('qty'),
                        'clinic_id'=>request('clinic'),
                         ];
                    $clincprod=ClinicInventory::where('clinic_id',request('clinic'))->where('product_id',$product->getproduct->id)->first();  
                    
                    if($clincprod){
                        $quantity=$clincprod->Quantity + request('qty');
                        $clincprod->update(['Quantity'=>$quantity]);
                        $reports=[
                            'user_id'=>Auth::user()->id,
                            'clinic_id'=>request('clinic'),
                            'product_id'=>$product->getproduct->id,
                            'requestQty'=>request('qty'),
                            'mainQty'=>$clincprod->Quantity,
                            'subQty'=>$quantity,
                        ];
                        Report::create($reports);
                        return response()->json(['success'=>true ,'product'=> $product]);
                        }
                        else{
                            ClinicInventory::create($data);
                            $reports=[
                                'user_id'=>Auth::user()->id,
                                'clinic_id'=>request('clinic'),
                                'product_id'=>$product->getproduct->id,
                                'requestQty'=>request('qty'),
                                'mainQty'=>request('qty'),
                                'subQty'=>request('qty'),
                            ];
                            Report::create($reports);

                            return response()->json(['success'=>true ,'product'=>$product]);
                        }
                     
                  

                }
            }

        }
        

}
    // $product->update($data);
    //   return $product;
    
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInventory $userInventory)
    {
        //
    }
}
