<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Sessioncalender;
use App\Models\Sessiontime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allsessions=array();
        $allsessionss=Session::all();
        foreach($allsessionss as $sessions ){
            $sessions->sessionuser;
           array_push($allsessions, $sessions);

        }
        return array_reverse($allsessions);
        //
    }
    public function gettime($id){
        $alltimeforsession=Sessiontime::where('sessioncalender_id',$id)->get();
        return $alltimeforsession;

    }
    public function calendar($id){
        $allcalenderorsession=Sessioncalender::where('session_id',$id)->get();
        return $allcalenderorsession;
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
          'sessionname'=>'required', 
          'sessionprice'=>'required', 
          'sessiontype'=>'required', 
          'sessionlink'=>'required', 
          'sessioncalender'=>'required|array|min:1',
          'sessioncalender.*' => 'required|date|distinct',
          'sessiontimes'=>'required|array|min:1',
          'sessiontimes.*' => 'required',
          ]);

          $link=null;
        if($request->sessionimage){
            $request->validate([
            'sessionimage' => 'image|mimes:jpg,jpeg,png,bmp',
            ]);
            if($request->hasFile('sessionimage')){
                $file = $request->file('sessionimage');
                $link=Storage::put('/sessions',$file);
             } 
        }
        $data=[
            'user_id'=>Auth::user()->id,
            'sessionname'=>$request->sessionname,
            'sessionimage'=> $link,
            'sessionlink'=>$request->sessionlink,
            'sessiontype'=> $request->sessiontype,
            'sessionprice'=>$request->sessionprice,
        ];
        $session=Session::create($data);
     
        $allcalender=$request->sessioncalender;
        foreach($allcalender as $clenderkey=>$calender){
            $sessioncalenderr=[
                'user_id'=>Auth::user()->id,
                'session_id'=>$session->id,
                'sessioncalender'=>$calender
            ];
            $seesioncalender=Sessioncalender::create($sessioncalenderr);
            $allcalendertime=$request->sessiontimes;
            foreach($allcalendertime as $time){
                $timee=json_decode($time);
                $datatimeconverttoarray=get_object_vars($timee);
                if($clenderkey===$datatimeconverttoarray['calenderid']){
                    $sessiontime=[
                        'user_id'=>Auth::user()->id,
                        'sessiontime'=>$datatimeconverttoarray['timee'],
                        'sessioncalender_id'=>$seesioncalender->id,
                    ];
                    $sessiontime=Sessiontime::create($sessiontime);
                }
            
            }
        }
return $session;

  }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {
           $request->validate([
          'sessionname'=>'required', 
          'sessionprice'=>'required', 
          'sessiontype'=>'required', 
          'sessionlink'=>'required', 
          'sessioncalender'=>'required|array|min:1',
          'sessioncalender.*' => 'required|distinct',
          'sessiontimes'=>'required|array|min:1',
          'sessiontimes.*' => 'required',
          ]);
          $session=Session::find(request('session_id'));

          $link=null;
         if($request->sessionimage){
            $request->validate([
            'sessionimage' => 'required',
            ]);
            $link=$request->sessionimage;
            if($request->hasFile('sessionimage')){
                $perviousimage= $session->getRawOriginal('sessionimage');
                $file = $request->file('sessionimage');
                $link=Storage::put('/sessions',$file);
                $session->update(['sessionimage'=>$link]);
                Storage::delete($perviousimage);

             } 
        }
        $data=[
            'user_id'=>Auth::user()->id,
            'sessionname'=>$request->sessionname,
            'sessionimage'=> $link,
            'sessionlink'=>$request->sessionlink,
            'sessiontype'=> $request->sessiontype,
            'sessionprice'=>$request->sessionprice,
        ];
     $session->update($data);
         $allcalender=$request->sessioncalender;
 
        foreach($allcalender as $clenderkey=>$calender){
             $sessioncalenderr=[
                'user_id'=>Auth::user()->id,
                'session_id'=>$session->id,
                'sessioncalender'=>$calender->sessioncalender
            ];
            $calender->update($sessioncalenderr);
            $allcalendertime=$request->sessiontimes;
            foreach($allcalendertime as $time){
                $timee=json_decode($time);
                $datatimeconverttoarray=get_object_vars($timee);
                if($clenderkey===$datatimeconverttoarray['calenderid']){
                    $sessiontime=[
                        'user_id'=>Auth::user()->id,
                        'sessiontime'=>$datatimeconverttoarray['timee'],
                        // 'sessioncalender_id'=>$seesioncalender->id,
                    ];
                    $sessiontime=Sessiontime::create($sessiontime);
                }
            
            }
        }
return $session;

  }
    public function sessionitemforbooking($id){
        $session=Session::find($id);
        $session->sessionuser;
        $session->sessioncalender;
        $session->sessiontimes;
        return $session;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
             $requests=Session::find($id);
            $requests->delete();
            return response()->noContent();
    }
}
