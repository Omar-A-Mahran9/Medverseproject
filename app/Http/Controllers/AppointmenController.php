<?php

namespace App\Http\Controllers;

use App\Models\Appointmen;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        if(Auth::user()->role=='ADMIN'){
        $allappointments=array();
        $allappointment=Appointmen::all();
        foreach($allappointment as $appoint ){
            $appoint->appointmentuser;
            $appoint->appointmentdate;
            $appoint->appointmenttime;
            $appoint->appointmentsession;
           array_push($allappointments, $appoint);
        }
        return $allappointments;
    }
    else{
        $allappointments=array();
        $allappointment=Appointmen::Where('user_id',Auth::user()->id)->get();
        foreach($allappointment as $appoint ){
            $appoint->appointmentuser;
            $appoint->appointmentdate;
            $appoint->appointmenttime;
            $appoint->appointmentsession;
           array_push($allappointments, $appoint);
        }
        return $allappointments;
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
        $request->validate([
                       'session_name' => ['required', 'integer'],
                       'session_type' => ['required'],
                       'date' => ['required'],
                       'time' => ['required'],
                       'client_id' => ['required'],
                    ]);
                    $sessionprice=Session::find($request->session_name)->sessionprice;
                  
        $data=[
            'user_id'=>$request->client_id,
            'session_id'=>$request->session_name,
            'sessioncalender_id'=>$request->date,
            'sessiontime_id'=>$request->time,
            'statue'=>$request->statue,
            'price'=>$sessionprice
        ];
        $appointment=Appointmen::create($data);
        return $appointment;
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointmen $appointmen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointmen $appointmen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointmen $appointmen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
                 $appoint=Appointmen::find($id);
                $appoint->delete();
                return response()->noContent();
    }
}
