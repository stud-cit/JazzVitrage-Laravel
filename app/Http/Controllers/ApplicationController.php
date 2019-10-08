<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Evaluation;
use App\Models\GroupPeople;
use App\Models\ApplicationType;
use App\Models\SoloDuet;
use App\Models\Preparation;
use App\Models\Presentation;
use App\Models\Nomination;

class ApplicationController extends Controller
{
    protected $publicStorage = '/memberFiles/';

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
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'nomination')->get();
         return response()->json($data);
     }
     
     public function getAllMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group')->where('status', '!=', 'archive')->get();
         return response()->json($data);
     }

     public function getMember($id)
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation')->where('application_id', '=', $id)->get();
         return response()->json($data);
     }

     public function getNominations()
     {
        $data = Nomination::orderBy('created_at', 'asc')->get();
        return response()->json($data);
     }

     public function postApp(Request $request) {
        $app = new Application;
        $school = new Preparation;
        $presentation = new Presentation;

        $data = json_decode($request->data);

        $app->nomination_id = $data->nomination;
        $app->application_type_id = $data->appType;
        $app->status = 'created';
        $app->save();

        if($data->appType == 1) {
            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName;
            $soloDuet->surname = $data->memberSurname;
            $soloDuet->patronomic = $data->memberPatronymic;
            $soloDuet->data_birthday = $data->memberDate;

            $soloDuet->parent_name = $data->parentName;
            $soloDuet->parent_surname = $data->parentSurname;
            $soloDuet->parent_patronomic = $data->parentPatronymic;
            $soloDuet->in = $data->idCode;
            $soloDuet->is_duet = 0;
            $soloDuet->application_id = $app->application_id;

            foreach($request->files as $k => $val) {
                $val["memberBirthdayFile"]
                    ->move(public_path().$this
                    ->publicStorage, time().'-'.$val["memberBirthdayFile"]->getClientOriginalName());
                $soloDuet->passport_photo = $val["memberBirthdayFile"]->getClientOriginalName();

                $val["idFile"]
                    ->move(public_path().$this
                    ->publicStorage, time().'-'.$val["idFile"]->getClientOriginalName());
                $soloDuet->in_file = $val["idFile"]->getClientOriginalName();
            }

            $soloDuet->save();
        }

        if($data->appType == 2) {
            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName;
            $soloDuet->surname = $data->memberSurname;
            $soloDuet->patronomic = $data->memberPatronymic;
            $soloDuet->data_birthday = $data->memberDate;

            $soloDuet->parent_name = $data->parentName;
            $soloDuet->parent_surname = $data->parentSurname;
            $soloDuet->parent_patronomic = $data->parentPatronymic;
            $soloDuet->in = $data->idCode;
            $soloDuet->is_duet = 1;
            $soloDuet->application_id = $app->application_id;

            foreach($request->files as $k => $val) {
                $val["memberBirthdayFile"]
                    ->move(public_path().$this
                    ->publicStorage, time().'-'.$val["memberBirthdayFile"]->getClientOriginalName());
                $soloDuet->passport_photo = $val["memberBirthdayFile"]->getClientOriginalName();

                $val["idFile"]
                    ->move(public_path().$this
                    ->publicStorage, time().'-'.$val["idFile"]->getClientOriginalName());
                $soloDuet->in_file = $val["idFile"]->getClientOriginalName();
            }
            $soloDuet->save();

            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName2;
            $soloDuet->surname = $data->memberSurname2;
            $soloDuet->patronomic = $data->memberPatronymic2;
            $soloDuet->data_birthday = $data->memberDate2;

            $soloDuet->parent_name = $data->parentName2;
            $soloDuet->parent_surname = $data->parentSurname2;
            $soloDuet->parent_patronomic = $data->parentPatronymic2;
            $soloDuet->in = $data->idCode2;
            $soloDuet->is_duet = 1;
            $soloDuet->application_id = $app->application_id;

            foreach($request->files as $k => $val) {
                $val["member2BirthdayFile"]
                    ->move(public_path().$this
                    ->publicStorage, time().'-'.$val["member2BirthdayFile"]->getClientOriginalName());
                $soloDuet->passport_photo = $val["member2BirthdayFile"]->getClientOriginalName();

                $val["idFile2"]
                    ->move(public_path().$this
                    ->publicStorage, time().'-'.$val["idFile2"]->getClientOriginalName());
                $soloDuet->in_file = $val["idFile2"]->getClientOriginalName();
            }

            $soloDuet->save();
        }

        if($data->appType > 2) {
            $group = new GroupPeople;
            $group->application_id = $app->application_id;
            $group->name = $data->groupName;
            $group->count_people = $data->groupCount;
            $group->average_age = $data->groupAverage;
            foreach($request->files as $k => $val) {
                $val["groupBirthdayFile"]
                    ->move(public_path().$this
                    ->publicStorage, time().'-'.$val["groupBirthdayFile"]->getClientOriginalName());
                $group->file = $val["groupBirthdayFile"]->getClientOriginalName();
            }
            $group->save();
        }

        $school->school_one = $data->schoolName;
        $school->school_address = $data->schoolAddress;
        $school->school_email = $data->schoolEmail;
        $school->school_phone = $data->schoolPhone;

        $school->teacher_name = $data->teacherName;
        $school->teacher_surname = $data->teacherSurname;
        $school->teacher_patronomic = $data->teacherPatronymic;
        $school->teacher_in = $data->teacherIdCode;
        $school->teacher_email = $data->teacherEmail;
        $school->teacher_phone = $data->teacherPhone;

        $school->is_concertmaster = ($data->concertName == '') ? 1 : 0;
        $school->concertmaster_name = $data->concertSurname;
        $school->concertmaster_surname = $data->concertName;
        $school->concertmaster_patronomic = $data->concertPatronymic;
        $school->application_id = $app->application_id;
        $school->save();

        $presentation->composition_one = $data->compositionName;
        $presentation->author_one = $data->compositionAuthor;
        $presentation->composition_two = $data->compositionName2;
        $presentation->author_two = $data->compositionAuthor2;
        $presentation->application_id = $app->application_id;
        foreach($request->files as $k => $val) {
            $val["compositionVideo"]
                ->move(public_path().$this
                ->publicStorage, time().'-'.$val["compositionVideo"]->getClientOriginalName());
            $presentation->video = $val["compositionVideo"]->getClientOriginalName();
        }
        $presentation->save();
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

    /**
     * Return all application end calculate rating
     * Return json
     */
    public function getRating() {
        $data = Application::with('appType', 'soloDuet', 'group', 'evaluations')->where('status', '!=', 'archive')->get()->toArray();
        //$data2;
        //var_dump($data);
        // $users = Application::all();
        // $users = $users->evaluations()->avg('evaluation');
        //$users = $users->fresh('evaluations')-avg('evaluation');
        // var_dump( $users);
        $data2 = array_map( function ($row) {
            return $row['evaluations'];
        } , $data);
        // foreach ($data->flatMap->evaluations as $eval) {
        //     $data2[] = $eval->evaluation;
        // }
        // var_dump($data2);

        return response()->json($data);
    }
}
