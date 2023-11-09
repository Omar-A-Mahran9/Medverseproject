<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
         $allclinics=Clinic::where('user_id',$id)->latest()->get();
        return $allclinics;
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
 
        $allclinics=$request->all();
        $totalprice=0;
        $allfillclinc=[];
        $allclincs=[];
        foreach( $allclinics as $clinic){

            if($clinic['name']!=""){
                 $totalprice+= $clinic['price'];
                $data=[
                    'clinicname'=>$clinic['name'],
                    'clinicpric'=>$clinic['price'],
                    'user_id'=>Auth::user()->id,
                ];
                
                array_push($allfillclinc,$data);
            }
        }
         if(count($allfillclinc)==0){
        return response(['massage'=>'You must fill one clinic at least']);
        }else{
            $order=[
                'number_of_clincs'=> count($allfillclinc),
                'user_id'=>Auth::user()->id,
                'total_price'=>$totalprice
               ];
            $order=Order::create($order);
            
   
foreach($allfillclinc as $clin){

    if($order->find($order->id)->statue==='PAID'){
        $data=[
            'clinicname'=>$clin['clinicname'],
            'clinicpric'=>$clin['clinicpric'],
            'user_id'=>$clin['user_id'],
            'order_id'=>$order->id,
            'mainclinic_id'=>Auth::user()->mainclinic->id,
            'statue'=>'ACCEPTED'
        ];
    }
    else{
        $data=[
            'clinicname'=>$clin['clinicname'],
            'clinicpric'=>$clin['clinicpric'],
            'user_id'=>$clin['user_id'],
            'order_id'=>$order->id,
        ];
    }
    $clinic=Clinic::create($data);
 array_push($allclincs,$clinic);
}
    }
  return $allclincs;
    }
    /**
     * Display the specified resource.
     */
    public function show(Clinic $clinic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clinic $clinic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinic $clinic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinic $clinic)
    {
        //
    }
}
