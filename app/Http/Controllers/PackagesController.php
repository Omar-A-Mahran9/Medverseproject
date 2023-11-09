<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use App\Models\subscriptions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class PackagesController extends Controller
{
    
    //
    public function index($type){
        if($type=='individual'){
            $packages = Packages::where('type','Individuals')->get();
            return $packages;
        }
        elseif($type=='clinic'){
            $packages = Packages::where('type','Clinics')->get();
            return $packages;
        }
        else{
            $packages = Packages::get();
                return $packages;
        }
        
               

    }
    public function store(Request $request){
 
if(Auth::user()->role!='ADMIN'){
    $statue=true; //paid statue
    $data=[
        'user_id'=>$request->user['id'],
        'Package_id'=>$request->packag['id'],
        'statue'=>true,
    ];
    $user=User::find($request->user['id']);
    $usersuscription=subscriptions::where('user_id',$request->user['id'])->first();

    if( $usersuscription){
       subscriptions::where('user_id',$request->user['id'])->update(['Package_id'=>$request->packag['id']]);
    }
    else{
        subscriptions::create($data);
    }
    $user->update([
        'Package_id'=>$request->packag['id']
    ]);  
    return response()->json(['message'=>'Your Subscription Confirmed']);
}
else{
    return response()->json(['error'=>'Sorry You are Admin']);
}
    }
}
