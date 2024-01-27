<?php

namespace App\Http\Controllers;

use App\Models\Admin\Groupproduct;
use App\Models\Admin\product;
use App\Models\Product_Request;
use App\Models\Qutation;
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
use Illuminate\Support\Facades\Validator;

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
            $allrequests=Requeest::with('Product_Request','getuser','getsupplier','getclient')->get();
           
        }
        elseif(Auth::user()->role=='SUPPLIER')
        {
            $allrequests=Requeest::with('Product_Request','getuser','getsupplier','getclient')->where('supplier_id',$id)->get();
           
        }
        else{
             
            $allrequests=Requeest::with('Product_Request','getuser','getsupplier','getclient')->where('user_id',$id)->orWhere('client_id',$id)->get();
        }
        foreach($allrequests as $request ){
            $qutation=Qutation::where('requests_id',$request->id)->first();
            if($qutation != null){
                $request['qutation'] = $qutation;            }
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
 
        $request->update([
            'statue'=>request('statue'),
        ]);
       
        return response()->json(['success'=>true]);

    }

    public function is_delivery(Requeest $request){
         $requestData=$request;
        $arrayOfRequest=$request->Product_Request->toArray();
        foreach($arrayOfRequest as $perrequest){
              $product=$perrequest['getproduct'];
              if(Auth::user()->role=='USER'){
                $reports=[
                    'user_id'=>Auth::user()->id,
                    'product_id'=>$product['id'],
                    'mainQty'=>$product['Qty'],
                ];
                }
         $productquantity=$product['Qty'];
         $requestqty=$perrequest['quantity'];
         $userrequest=User::find($requestData->user_id);
         if(Auth::user()->role=='USER' && ($productquantity<$requestqty || $productquantity==0)){
            return response()->json(['erroor'=>"Sorry You do not have enough Quantity from " .  $perrequest['getproduct']['productname'] . " in your inventory"]);
        }
            else{
            if((Auth::user()->role=='USER')){
                $newquatity=$productquantity-$requestqty;
            }
                if(request('statue')=='true'){   
                $productModel=product::findOrFail($product['id']);     
                 $productModel->update([
                    'Qty'=>$newquatity
                ]);
 
                $reports=Arr::add($reports, 'subQty', $productModel->Qty);
                
                $reports= Arr::add($reports, 'requestQty', $perrequest['quantity']);

                $report=Report::create($reports);
        
                if(Auth::user()->role=='USER' && $requestData->client_id!=null){
                    $alluserinventory=UserInventory::where('user_id',$requestData->client_id)->where('product_id',$perrequest['productid'])->first();
                }
                else{
                    $alluserinventory=UserInventory::where('user_id',$requestData->user_id)->where('product_id',$perrequest['productid'])->first();
                }
                if($alluserinventory){
                  
                        $reports=[
                            'user_id'=>$requestData->user_id,
                            'product_id'=>$perrequest['productid'],
                            'mainQty'=>$alluserinventory->Quantity];
                        $alluserinventory->update([
                            'Quantity'=>$alluserinventory->Quantity+$requestqty
                        ]);

                        $reports=Arr::add($reports, 'subQty', $alluserinventory->Quantity);
                        $reports= Arr::add($reports, 'requestQty',$requestqty );

                        $report=Report::create($reports);
                    
                    }
                else{
                        if($requestData->client_id!=null){
                            UserInventory::create([
                                'user_id'=>$requestData->client_id,
                                'product_id'=>$perrequest['productid'],
                                'Quantity'=> $requestqty,
                            ]);    
                            $reports=[
                                'user_id'=>$requestData->client_id,
                                'product_id'=>$perrequest['productid'],
                                'requestQty'=>$requestqty,
                                'mainQty'=>$requestqty,
                                'subQty'=>$requestqty,
                            ];     
                            $report=Report::create($reports);
    
                        }
                        else{
                            UserInventory::create([
                                'user_id'=>$requestData->user_id,
                                'product_id'=>$perrequest['productid'],
                                'Quantity'=> $requestqty,
                            ]);  
                            $reports=[
                                'user_id'=>$requestData->user_id,
                                'product_id'=>$perrequest['productid'],
                                'requestQty'=>$requestqty,
                                'mainQty'=>$requestqty,
                                'subQty'=>$requestqty,
                            ];     
                            $report=Report::create($reports);
                        }
                        
                }
            
            }
                else{
                    $request->update([
                        'is_Delivered'=>request('statue'),
                    ]);
                   
                    return response()->json(['success'=>true]);

                }
        }

        }
        
        $request->update([
            'is_Delivered'=>request('statue'),
        ]);
       
        return response()->json(['success'=>true]);
    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'requestsend' => 'required|json',
        ]);
        
        // Decode the JSON data
        $requestData = json_decode($validatedData['requestsend'], true);
        
        // Merge the decoded data into the request
        $request->merge($requestData);
        if(Auth::user()->role=="ADMIN"){
            $request->validate([
                'clientname' => 'required',
                'suppliername' => 'required',

            ],[
                'clientname' => 'The client name is required.',
                'suppliername' => 'The supplier name is required.',

            ]);
        }
        else{
            $request->validate([
                'suppliername' => 'required',
            ],
            [
                'suppliername' => 'The supplier name is required.',
    
            ]);
        }
        // Validate the individual fields within the decoded data
    


        $validate=$request->validate([
            'request.*.productid' => 'required',
            'request.*.productdescription' => 'required',
            'request.*.quantity' => 'required|numeric',
        ],
 
        [
            'request.*.productid.required' => 'The product ID is required.',
            'request.*.productdescription.required' => 'The product description is required.',
             'request.*.quantity.required' => 'The quantity is required.',
            'request.*.quantity.numeric' => 'The quantity must be a numeric value.',
        ]);
   
             $maindata=[
                'user_id'=>Auth::user()->id,
                'supplier_id'=>$request->suppliername,
                'client_id'=>$request->clientname,
            ];
 
            $req=Requeest::create($maindata);
        
            
            foreach ($request['request'] as $subdata) {
                $subdata['request_id'] = $req->id;
                $prod_req=Product_Request::create($subdata);     
      }

            return response()->json(['message'=>'Request send successfully']);
 
    }

 
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





