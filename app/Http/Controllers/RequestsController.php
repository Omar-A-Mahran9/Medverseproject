<?php

namespace App\Http\Controllers;

use App\Models\Admin\Groupproduct;
use App\Models\Admin\product;
use App\Models\Report;
use App\Models\Requeest;
use App\Models\User;
use App\Models\UserInventory;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    { 
 
        $allrequest=array();
        if(Auth::user()->role=='ADMIN'){
            $allrequests=Requeest::get();
        }
        elseif(Auth::user()->role=='SUPPLIER')
        {
            $allrequests=Requeest::where('supplier_id',$id)->get();
 
        }
        else{
             
            $allrequests=Requeest::where('user_id',$id)->get();
        }
        foreach($allrequests as $request ){
             $request->getsupplier;
             $request->getuser;
             $request->getproduct;
            array_push($allrequest, $request);
         }
    
        return $allrequest;
    }
    public function filter($idd){
         $allrequest=array();
         if(Auth::user()->role=='ADMIN'){
            if(request('request')){
                 $allrequests = Requeest::where('productid',request('request'))->whereMonth('created_at', intval(request('month')))->whereYear('created_at', intval(request('year')))->get();
                $totalReport= Report::where('product_id',request('request'))->whereMonth('created_at', intval(request('month')))->whereYear('created_at', intval(request('year')))->get();
               
 
            }
            else{
                $allrequests = Requeest::whereMonth('created_at', intval(request('month')))->whereYear('created_at', intval(request('year')))->get();
            }
        }
        else{
            if(request('request')){
                $allrequests = Requeest::where('user_id',request('user_id'))->where('productid',request('request'))->whereMonth('created_at', intval(request('month')))->whereYear('created_at', intval(request('year')))->get();
                $totalReport= Report::where('product_id',request('request'))->whereMonth('created_at', intval(request('month')))->whereYear('created_at', intval(request('year')))->get();

            }
            else{
                $allrequests = Requeest::where('user_id',request('user_id'))->whereMonth('created_at', intval(request('month')))->whereYear('created_at', intval(request('year')))->get();
            }
        }
  

        foreach($allrequests as $request ){
            $request->getsupplier;
             $request->getuser;
             $request->getproduct;
             if(request('request')){
                array_push($allrequest, $request);
             }
              if(request('group') == $request->getproduct->group && !request('request')){
                  array_push($allrequest, $request);
             }
          }

         $totalsale=0;
         $product=product::find($request->getproduct->id);
         $userproduct=UserInventory::where('user_id',Auth::user()->id)->where('product_id',$request->getproduct->id)->first();
         
           if(Auth::user()->role=='ADMIN'){
            $totalsale= $product->Qty * $product->price;
            if( isset($totalReport)){
                $monthlysale= $totalReport->where('user_id','!=' ,Auth::user()->id)->sum('requestQty')* $product->price;
            }
            $totalquantity=$product->Qty;
            if( isset($totalReport)){
            $soldquantity=$totalReport->where('user_id','!=' ,Auth::user()->id)->sum('requestQty');
            }
           }
           else{
            $totalsale= $userproduct->Quantity * $userproduct->getproduct->price;
            if( isset($totalReport)){
            $monthlysale= $totalReport->where('user_id',Auth::user()->id)->where('clinic_id',"!=",null)->sum('requestQty')* $userproduct->getproduct->price;
            }
            $totalquantity=$userproduct->Quantity;
            if( isset($totalReport)){
            $soldquantity=$totalReport->where('user_id',Auth::user()->id)->where('clinic_id',"!=",null)->sum('requestQty');
            }  
        }
                    
        // ---------------------------------------------
      if(isset($monthlysale)&&isset($soldquantity)){
        return response()->json(['allrequest'=>$allrequest,'myinventory'=>$totalsale,'monthlysale'=>$monthlysale ,'totalquantity'=>$totalquantity,'soldquantity'=>$soldquantity]);
      }
      else{
         return response()->json(['allrequest'=>$allrequest]);

      }

         
     }
     public function analysis($id){
        $allrequest=array();
        if(Auth::user()->role=='ADMIN'){
            $allrequests = Requeest::whereMonth('created_at', intval(request('month')))->whereYear('created_at', intval(request('year')))->get();
        }
        else{
            $allrequests = Requeest::where('user_id',$id)->whereMonth('created_at', intval(request('month')))->whereYear('created_at', intval(request('year')))->get();
        }
        foreach($allrequests as $request ){
            $request->getsupplier;
             $request->getuser;
             $request->getproduct;
             array_push($allrequest, $request);
         }
         $maxrequest=array();
        
    
         foreach( $allrequest as $req){
            $reqe= $allrequests->where('productid',$req->productid)->sum('quantity');
            array_push($maxrequest,['productdetails'=>$req,'product'=>$req->getproduct->productname,'totalquzntity'=> $reqe]);
          };

          $bestproduct=max('totalquzntity',$maxrequest);
 
        return response()->json(['bestproduct'=> $bestproduct]);

     }
     public function changeRole(Requeest $request){
        $product=product::findOrFail($request->productid);
        if(Auth::user()->role=='ADMIN'){
        $reports=[
            'user_id'=>Auth::user()->id,
            'product_id'=>$product->id,
            'mainQty'=>$product->Qty,
        ];
        }
 
        $productquantity=$product->Qty;
        $requestqty=$request->quantity;
        $userrequest=User::find($request->user_id);
        if(Auth::user()->role=='ADMIN' && ($productquantity<$requestqty ||$productquantity==0)){
            return response()->json(['erroor'=>'Sorry You do not have enough Quantity from this product']);
        }
        else{
              if((Auth::user()->role=='ADMIN')){
                $newquatity=$productquantity-$requestqty;
             }
             else{
                $newquatity=$productquantity;
            }
        if(request('statue')=='ACCEPTED'){
            $request->update([
                'statue'=>request('statue'),
             ]);
             
             $product->update([
                'Qty'=>$newquatity
            ]);

            $reports=Arr::add($reports, 'subQty', $product->Qty);
            $reports= Arr::add($reports, 'requestQty', $request->quantity);

            $report=Report::create($reports);
       
            if(Auth::user()->role=='ADMIN' && $request->client_id!=null){
                $alluserinventory=UserInventory::where('user_id',$request->client_id)->where('product_id',$request->productid)->first();
            }
            else{
               $alluserinventory=UserInventory::where('user_id',$request->user_id)->where('product_id',$request->productid)->first();
           }
                if($alluserinventory){
                    $reports=[
                        'user_id'=>$request->user_id,
                        'product_id'=>$request->productid,
                        'mainQty'=>$alluserinventory->Quantity];
                    $alluserinventory->update([
                        'Quantity'=>$alluserinventory->Quantity+$requestqty
                    ]);

                    $reports=Arr::add($reports, 'subQty', $alluserinventory->Quantity);
                    $reports= Arr::add($reports, 'requestQty',$requestqty );

                    $report=Report::create($reports);
                  
                }
                else{
                    if($request->client_id!=null){
                        UserInventory::create([
                            'user_id'=>$request->client_id,
                            'product_id'=>$request->productid,
                            'Quantity'=> $requestqty,
                        ]);    
                        $reports=[
                            'user_id'=>$request->client_id,
                            'product_id'=>$request->productid,
                            'requestQty'=>$requestqty,
                            'mainQty'=>$requestqty,
                            'subQty'=>$requestqty,
                        ];     
                        $report=Report::create($reports);
 
                    }
                    else{
                        UserInventory::create([
                            'user_id'=>$request->user_id,
                            'product_id'=>$request->productid,
                            'Quantity'=> $requestqty,
                        ]);  
                        $reports=[
                            'user_id'=>$request->user_id,
                            'product_id'=>$request->productid,
                            'requestQty'=>$requestqty,
                            'mainQty'=>$requestqty,
                            'subQty'=>$requestqty,
                        ];     
                        $report=Report::create($reports);
 
                    }
                     
                    }
                    return response()->json(['success'=>true]);
         
             }
        else{
            $request->update([
                'statue'=>request('statue'),
             ]);
             return response()->json(['success'=>true]);

        }
        }

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
         $validate=$request->validate([
        'productid'=>'required',
        'productdescription'=>'required',
        'suppliername'=>'required',
        'quantity'=>'required',
    ]);
    $link=null;

    if($request->image){
        $request->validate([
        'image' => 'image|mimes:jpg,jpeg,png,bmp',
        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $link=Storage::put('/requests',$file);
         } 
    }
    if(Auth::user()->role=="ADMIN"){
        $request->validate([
            'clientname'=>'required',
        ]);
    }
   
    $data=[
        'productid'=>$request->productid,
        'productdescription'=>$request->productdescription,
        'user_id'=>$request->currentuser,
        'client_id'=> $request->clientname,
        'quantity'=>$request->quantity,
        'supplier_id'=>$request->suppliername,
        'image'=>$link
    ];
    Requeest::create($data);
    return response()->json(['message'=>'Request send successfully']);
 
    }

    /**
     * Display the specified resource.
     */
    public function show(Requeest $requests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requeest $requests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requeest $requests,$id)
    {
        $reqID=$requests->find($id);
        $validate=$request->validate([
            'productid'=>'required',
            'productdescription'=>'required',
            'quantity'=>'required',
            'suppliername'=>'required',

        ]);
        $link=null;
    
        if($request->image!=null){
 
            $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png,bmp',
            ]);
            if($request->hasFile('image')){
            $perviousimage=$reqID->getRawOriginal('image');

                $file = $request->file('image');
                $link=Storage::put('/requests',$file);
             } 
        }
        if(Auth::user()->role=="ADMIN"){
            $request->validate([
                'clientname'=>'required',
            ]);
        }
       
        $data=[
            'productid'=>$request->productid,
            'productdescription'=>$request->productdescription,
            'user_id'=>$request->currentuser,
            'client_id'=> $request->clientname,
            'quantity'=>$request->quantity,
            'supplier_id'=>$request->suppliername,
            'image'=>$link
        ];
        $reqID->update($data);
        $reqID->getsupplier;
        $reqID->getuser;
        $reqID->getproduct;
        return response()->json(['request'=>$reqID,'message'=>'Request send successfully']);
     
    }

    /**
     * Remove the specified resource from storage.
     */
 
    public function destroy($id){
        
        $requests=Requeest::find($id);
        $requests->delete();
        return response()->noContent();
    }
}





