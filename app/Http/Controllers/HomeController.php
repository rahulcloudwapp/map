<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Location;

use Auth;
use DB;
use Str;
use Hash;

class HomeController extends Controller
{
    public function map()
    {
        $locations = Location::get();
        return view('web.map',compact('locations'));
    }
    
    
}
