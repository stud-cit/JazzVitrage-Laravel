<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\GroupPeople;
use App\Models\ApplicationType;
use App\Models\Preparation;
use App\Models\Presentation;

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
         $data = Application::with('appType', 'soloDuet', 'group')->get();
         return response()->json($data);
     }
     
     public function getAllMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group')->where('status', '!=', 'archive')->get();
         return response()->json($data);
     }

     public function getAllJury()
     {
         $data = "";
         return response()->json($data);
     }

     public function getMember($id)
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation')->where('application_id', '=', $id)->get();
         return response()->json($data);
     }

    public function archiveMembers($id)
    {
        $model = Application::find($id);

        $model->status = 'archive';

        if($model->save()){
            return 'ok';
        }

    }
    public function unarchiveMembers($id)
    {
        $model = Application::find($id);

        $model->status = 'created';

        if($model->save()){
            return ;
        }

    }
    public function deleteMembers($id)
    {
        $model = Application::find($id);

        if($model->delete()){
            return ;
        }

    }
}
