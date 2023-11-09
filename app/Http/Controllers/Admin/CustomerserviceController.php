<?php

 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customerservice;
use Illuminate\Http\Request;

class CustomerserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allcomments=array();
        $allcommentss=Customerservice::get();
        foreach($allcommentss as $comment ){
 
            $comment->getuser;
           array_push($allcomments, $comment);
        }
         return $allcomments;
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
$request->validate([
    'title'=>'required',
    'comment'=>'required',
    'user_id'=>'required'
]);

$data=[
    'title'=>$request->title,
    'comment'=>$request->comment,
    'user_id'=>$request->user_id,

];
Customerservice::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(customerservice $customerservice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customerservice $customerservice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customerservice $customerservice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($customerservice)
    {
         $requests=customerservice::find($customerservice);
        $requests->delete();
        return response()->noContent();
    }
}
