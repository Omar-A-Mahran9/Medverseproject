<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allevent=Events::latest()->get();
        return $allevent;
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
            'eventname'=>'required',
            'eventdate'=>'required',
            'eventlink'=>'required',
            'eventlocation'=>'required',
        ]);
        $link=null;
        if($request->eventimage){
            $request->validate([
            'eventimage' => 'image|mimes:jpg,jpeg,png,bmp',
            ]);
            if($request->hasFile('eventimage')){
                $file = $request->file('eventimage');
                $link=Storage::put('/events',$file);
             } 
        }
        $data=[
            'eventname'=>$request->eventname,
            'eventdate'=>$request->eventdate,
            'eventlink'=>$request->eventlink,
            'eventlocation'=> $request->eventlocation,
            'user_id'=>Auth::user()->id,
            'image'=>$link
        ];
        $newevent=Events::create($data);
        return $newevent;
     
    }

    /**
     * Display the specified resource.
     */
    public function show(Events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Events $events)
    {
        $event=$events->find($request->eventid);
        $validate=$request->validate([
            'eventname'=>'required',
            'eventdate'=>'required',
            'eventlink'=>'required',
            'eventlocation'=>'required',
        ]);
        $link=$event->getRawOriginal('image');
         if($request->eventimage){
            $request->validate([
            'eventimage' => 'image|mimes:jpg,jpeg,png,bmp',
            ]);
        if($request->hasFile('eventimage')){
            $perviousimage=$event->getRawOriginal('image');
            $link=Storage::put('/event',$request->file('eventimage'));
            $event->update(['image'=>$link]);
            Storage::delete($perviousimage);
        }
    }
    $data=[
        'eventname'=>$request->eventname,
        'eventdate'=>$request->eventdate,
        'eventlink'=>$request->eventlink,
        'eventlocation'=> $request->eventlocation,
        'user_id'=>Auth::user()->id,
        'image'=>$link
    ];
    $dataa=$event->update($data);
    return $event;
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=Events::find($id);
        $user->delete();
      return response()->noContent();
    }
}
