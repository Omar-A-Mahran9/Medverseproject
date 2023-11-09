<?php

namespace App\Http\Controllers;

use App\Models\Admin\product;
use App\Models\ClinicInventory;
use App\Models\Report;
use App\Models\UserInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product=product::latest()->get();
        return $product;
    }

    public function indexproduct($id)
    {
        if(Auth::user()->role=='ADMIN'){
            $product=product::latest()->get();
        }
        else{
            $product=[];
            $userinv=UserInventory::where('user_id',$id)->latest()->get();
             foreach($userinv as $userproduct ){
                $userproduct->getproduct;
               array_push($product, $userproduct);
            }
           

        }

        return $product;
        //
    }
 

    public function addquantity(Request $request )
    {
        $product=product::where('id',$request->productid)->first();
        if(Auth::user()->role=='ADMIN'){
            $data=[
                'Qty'=>request('Quantity'),
            ];
            $reports=[
                'user_id'=>Auth::user()->id,
                'product_id'=>$product->id,
                'requestQty'=>request('Quantity')-$product->Qty,
                'mainQty'=>$product->Qty,
            ];
  
        $product->update($data);
        $rer= Arr::add($reports, 'subQty',$product->Qty );
        $report=Report::create($rer);
        }
 
        return $product;
        //
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
        $validate= request()->validate([
            'productname'=>'required',
            'productcode'=>'required|unique:products,productcode',
            'group_id'=>'required',
            'price'=>'required',
            'qty'=>'required',
        ]);
        $data=[
            'productcode'=>request('productcode'),
            'productname'=>request('productname'),
            'group'=>request('group_id'),
            'price'=>request('price'),
            'Qty'=>request('qty'),
        ];
 
        $product=product::create($data);

        if(Auth::user()->role=='ADMIN'){
        $reports=[
            'user_id'=>Auth::user()->id,
            'product_id'=>$product->id,
            'requestQty'=>request('qty'),
            'mainQty'=>request('qty'),
            'subQty'=>request('qty'),
        ];
        $report=Report::create($reports);
    }
      return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        
          $validate= request()->validate([
            'productname'=>'required',
            'productcode'=>'required',
            'group_id'=>'required',
            'price'=>'required',
            'qty'=>'required',
        ]);
        $data=[
            'productcode'=>request('productcode'),
            'productname'=>request('productname'),
            'group'=>request('group_id'),
            'price'=>request('price'),
            'Qty'=>request('qty'),
        ];
    $product->update($data);

    $reportt=Report::where('user_id',Auth::user()->id)->where('product_id',$product->id)->where('clinic_id',null)->get();
    if($reportt){
        foreach( $reportt as $item){
            $item->delete();
        }
    }
    if(Auth::user()->role=='ADMIN'){
        $reports=[
            'user_id'=>Auth::user()->id,
            'product_id'=>$product->id,
            'requestQty'=>request('qty'),
            'mainQty'=>request('qty'),
            'subQty'=>request('qty'),
        ];
            $report=Report::create($reports);
    }
      return $product;
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        if(Auth::user()->role=='ADMIN'){
        $product = product::findOrFail(request()->id);
        $product->delete();
        }else{
            $product=UserInventory::findOrFail(request()->id);
            $product->delete();
        }
        
return response()->noContent();
    }
}
