<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationType;

class ApplicationController extends Controller
{
    public function index()
    {	



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
     
     public function getAllMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group')->where('status', '!=', 'archive')->get();
         return response()->json($data);
     }

    public function archiveMembers($id)
    {
        $model = Application::find($id);

        $model->status = 'archive';

        if($model->save()){
            return 'ok';
        }
//        if($model->appType->name == 'дует' || $model->appType->name == 'соліст'){
//
//        }

    }
}
