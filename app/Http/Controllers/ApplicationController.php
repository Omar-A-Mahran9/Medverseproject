<?php

namespace App\Http\Controllers;

use App\Models\setting;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __invoke()
    {
        // return view('Home.error');
        $allsetting=setting::get();
        return view('admindashboard.layout.master',compact('allsetting'));

        // return view('admindashboard.layout.master');
    }
    
    public function index(){
        $allsetting=setting::get();

        return view('admindashboard.layout.master',compact('allsetting'));
        // return view('Home.home');


    }
 
}
