<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationType;

class ApplicationController extends Controller
{
    public function index()
    {	
//    	 $model = Application::with('appType', 'soloDuet', 'group')->get();


        return view('application');
    }
    public function store(Request $request)
    {
        // TO DO
    }

     public function getMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group')->where('status', '=', 'created')->get();
         return response()->json($data);
     }
}
