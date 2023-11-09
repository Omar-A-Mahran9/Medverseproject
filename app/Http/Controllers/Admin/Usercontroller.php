<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mainclinics;
use App\Models\setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class  Usercontroller extends Controller
{
    protected $guard;

 
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function Registerr(){
        if(Auth::user()){
            return redirect('/profile');
        }
        else{
return view('auth.Signup');
}
    }
public function index(){
    $allsetting=setting::get();
        $allusers=User::latest()->paginate($allsetting[3]['value']);

 
    return  $allusers;
}

public function users(){
    $allusers=User::latest()->get();
    
    return  $allusers;
}



public function search(){
$searchquery=request('query');
$users=User::where('name','like',"%{$searchquery}%")->get();
return response()->json($users);
}
public function changeRole(User $user){

  $user->update([
'role'=>request('role'),
  ]);
 
  return response()->json(['success'=>true]);
}
 
public function store(){
    request()->validate([
        'name'=>'required',
        'email'=>'required|unique:users,email',
        'password'=>'required|min:8'
    ]);
    $user=[
        'name'=>request('name'),
        'phone'=>request('phone'),
        'email'=>request('email'),
        'city'=>request('city'),
        'clinicname'=>request('clinicname'),
        'Address'=>request('address'),
        // 'role'=>request('role'),
        'Location'=>request('location'),
        'packages'=>request('packages'),
        'password'=>bcrypt(request('password')),
    ];
    $usercreated=User::create($user);
return $usercreated;
}
public function update(User $user){
    request()->validate([
        'name'=>'required',
        'email'=>['required','email',Rule::unique('users')->ignore($user->id)],
    ]);
    $userdata=[
        'name'=>request('name'),
        'phone'=>request('phone'),
        'email'=>request('email'),
        'city'=>request('city'),
        'clinicname'=>request('clinicname'),
        'Address'=>request('address'),
   
        'Location'=>request('location'),
        'packages'=>request('packages'),
        'password'=>request('password') ? bcrypt(request('password')):$user->password,
    ];

    $user->update($userdata); 
    return $user;
 

}
public function destroy($user){
    $user=User::find($user);
  $user->delete();
return response()->noContent();
}

public function Register(){
    request()->validate([
 
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:8',
            'phone'=>'required',
            'city'=> "required",
            'Address'=> "required",
            'type'=> "required",
    ]);
    if(request('type')=='DOCTOR'){
        request()->validate([
            'clinicname'=> "required",
    ]);
    }
    if(request('type')=='STUDENT'){
        request()->validate([
            'universityname'=> "required",
    ]);
    }
    if(request('type')=='Others'){
        request()->validate([
            'companyname'=> "required",
    ]);
    }
    
    $user=[
        'name'=>request('name'),
        'phone'=>request('phone'),
        'email'=>request('email'),
        'city'=>request('city'),
        'clinicname'=>request('clinicname'),
        'universityname'=>request('universityname'),
        'companyname'=>request('companyname'),
        'Address'=>request('address'),
        // 'role'=>request('role'),
        // 'Location'=>request('location'),
        'type'=>request('type'),
        'password'=>bcrypt(request('password')),
    ];
    $usercreated=User::create($user);
    if(request('clinicname')){
     $hosbiatl=[
        'hosbitalneme'=>request('clinicname'),
        'user_id'=>$usercreated->id
    ];
    $hosbi=Mainclinics::create($hosbiatl);
     }
    return redirect('/login')->with('mass','welcome you are registerd Successfully');
 
}
 
}
