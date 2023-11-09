<?php

namespace App\Http\Controllers;

use App\Models\setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allsetting=setting::pluck('value','key')->toArray();
         return $allsetting;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, setting $setting)
    {
         $request->validate([
            'clincprice'=>'required|int',
            'app_Name'=>'required|string',
            'data_format'=>'required|string',
            'paginationlimit'=>'required|int|min:1|max:100'

        ]);

        $setting=$request->all();
        
        foreach($setting as $key=>$value){
      
            setting::where('key',$key)->update(['value'=>$value]);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(setting $setting)
    {
        //
    }
}
