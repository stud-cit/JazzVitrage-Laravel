<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationType;

class ApplicationController extends Controller
{
    public function index()
    {	
    	// $model = Application::find(1)->appType;
    	// dd($model);

        return view('application');
    }
    public function store(Request $request)
    {
        // TO DO
    }

    // public function getMembers()
    // {
    	
    //     return [
    //     	'names' =>,
    //     	'types' =>
    //     ]
    // }
}
