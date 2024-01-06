<?php

namespace App\Http\Controllers;

use App\Models\Qutation;
use App\Models\Requeest;
use App\Models\User;
use Illuminate\Http\Request;

class QutationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
          $data=[
            'requests_id'=>$request['request']['requestid'],
            'Taxes'=>$request->Taxes,
            'Delivery'=>$request->Delivery,
            'user_id'=>$request->user,
        ];
        Qutation::create($data);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Qutation $qutation,$id)
    {
        $qutation = Qutation::where('requests_id',$id)->with('getrequest','getuser')->first();
        $totalprice=[];
        foreach($qutation->getrequest->Product_Request as $product){

            $totalpriceproduct=$product->getproduct->price*$product->quantity;
            array_push($totalprice ,$totalpriceproduct );

        }
        $totalquottionaprice=array_sum($totalprice);

        return [
            'qutation' => $qutation,
            'totalquottionaprice' => $totalquottionaprice,
        ];
      
    }
    public function changestatue($quotationsearch){
        $data = request()->all();
        if ($data["statue"] == "REJECTED"){
            request()->validate([
                'comment'=>'required'
            ]);
            $comment=$data['comment'];
        }
        $comment=null;
        $statue = $data['statue'];
        $qutation=Qutation::findOrFail($quotationsearch);
        $qutation->statue=$statue;
        $qutation->refuse_comment=$comment;
        $qutation->save();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qutation $qutation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qutation $qutation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qutation $qutation)
    {
        //
    }
}
