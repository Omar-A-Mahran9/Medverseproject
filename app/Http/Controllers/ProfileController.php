<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
     return view('auth.profilepage');
    }
    public function index()
    {
        $user=Auth::user();
        return $user ;
    }
public function updatepass(Request $request,UpdateUserPassword $updater){
$updater->update(
    auth()->user(),
    [
        'current_password'=>$request->currentpass,
        'password'=>$request->newpass,
        'password_confirmation'=>$request->confirmpass
    ]
    );

}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
public function uploadimage(Request $request){
    
    if($request->hasFile('Profile_image')){
        $request->validate([
            'Profile_image' => 'image|mimes:jpg,jpeg,png,bmp',
            ]);        $perviousimage=$request->user()->getRawOriginal('image');
         $link=Storage::put('/photos',$request->file('Profile_image'));
        $request->user()->update(['image'=>$link]);
        Storage::delete($perviousimage);
    }

}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name'=>"required",
            'email'=>["required",'email',Rule::unique('users')->ignore($request->user()->id)],
            'username'=>['required'],
            'city'=>[''],
            'phone'=>[''],
            'position'=>[''],
        ]);
        $user= $validate;
//    User::findOrfail($request->id)->update($user);
         $request->user()->update($user);
    
    return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
