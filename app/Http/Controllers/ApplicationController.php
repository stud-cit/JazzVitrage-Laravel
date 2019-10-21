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
use Illuminate\Support\Facades\Session;
use App\Mail\MemberEmail;
use Illuminate\Support\Facades\Mail;

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
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation', 'nomination')->where('status', '!=', 'archive')->get();
         return response()->json($data);
     }
     
     public function getAllMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation')->where('status', '!=', 'archive')->get();
         return response()->json($data);
     }
     
     public function getArciveMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'presentation')->where('status', '=', 'archive')->get();
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
            $soloDuet->patronymic = $data->memberPatronymic;
            $soloDuet->data_birthday = date("Y-m-d", strtotime($data->memberDate));
            $soloDuet->member_email = $data->memberEmail;

            $soloDuet->parent_name = $data->parentName;
            $soloDuet->parent_surname = $data->parentSurname;
            $soloDuet->parent_patronymic = $data->parentPatronymic;
            $soloDuet->in = $data->idCode;
            $soloDuet->is_duet = 0;
            $soloDuet->application_id = $app->application_id;

            foreach($request->files as $k => $val) {
                $member_birthday_file = time().'-'.$val["memberBirthdayFile"]->getClientOriginalName();
                $val["memberBirthdayFile"]
                    ->move(public_path().$this
                    ->publicStorage, $member_birthday_file);
                $soloDuet->passport_photo = $member_birthday_file;

                $id_file = time().'-'.$val["idFile"]->getClientOriginalName();
                $val["idFile"]
                    ->move(public_path().$this
                    ->publicStorage, $id_file);
                $soloDuet->in_file = $id_file;
            }

            $soloDuet->save();
        }

        if($data->appType == 2) {
            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName;
            $soloDuet->surname = $data->memberSurname;
            $soloDuet->patronymic = $data->memberPatronymic;
            $soloDuet->member_email = $data->memberEmail1;
            $soloDuet->data_birthday = date("Y-m-d", strtotime($data->memberDate));

            $soloDuet->parent_name = $data->parentName;
            $soloDuet->parent_surname = $data->parentSurname;
            $soloDuet->parent_patronymic = $data->parentPatronymic;
            $soloDuet->in = $data->idCode;
            $soloDuet->is_duet = 1;
            $soloDuet->application_id = $app->application_id;

            foreach($request->files as $k => $val) {
                $member_birthday_file = time().'-'.$val["memberBirthdayFile"]->getClientOriginalName();
                $val["memberBirthdayFile"]
                    ->move(public_path().$this
                    ->publicStorage, $member_birthday_file);
                $soloDuet->passport_photo = $member_birthday_file;

                $id_file = time().'-'.$val["idFile"]->getClientOriginalName();
                $val["idFile"]
                    ->move(public_path().$this
                    ->publicStorage, $id_file);
                $soloDuet->in_file = $id_file;
            }
            $soloDuet->save();

            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName2;
            $soloDuet->surname = $data->memberSurname2;
            $soloDuet->patronymic = $data->memberPatronymic2;
            $soloDuet->member_email = $data->memberEmail2;
            $soloDuet->data_birthday = date("Y-m-d", strtotime($data->memberDate2));

            $soloDuet->parent_name = $data->parentName2;
            $soloDuet->parent_surname = $data->parentSurname2;
            $soloDuet->parent_patronymic = $data->parentPatronymic2;
            $soloDuet->in = $data->idCode2;
            $soloDuet->is_duet = 1;
            $soloDuet->application_id = $app->application_id;

            foreach($request->files as $k => $val) {
                $member2_birthday_file = time().'-'.$val["member2BirthdayFile"]->getClientOriginalName();
                $val["member2BirthdayFile"]
                    ->move(public_path().$this
                    ->publicStorage, $member2_birthday_file);
                $soloDuet->passport_photo = $member2_birthday_file;

                $id_file2 = time().'-'.$val["idFile2"]->getClientOriginalName();
                $val["idFile2"]
                    ->move(public_path().$this
                    ->publicStorage, $id_file2);
                $soloDuet->in_file = $id_file2;
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
                $group_birthday_file = time().'-'.$val["groupBirthdayFile"]->getClientOriginalName();
                $val["groupBirthdayFile"]
                    ->move(public_path().$this
                    ->publicStorage, $group_birthday_file);
                $group->file = $group_birthday_file;
            }
            $group->save();
        }

        $school->school_one = $data->schoolName;
        $school->school_address = $data->schoolAddress;
        $school->school_email = $data->schoolEmail;
        $school->school_phone = $data->schoolPhone;

        $school->teacher_name = $data->teacherName;
        $school->teacher_surname = $data->teacherSurname;
        $school->teacher_patronymic = $data->teacherPatronymic;
        $school->teacher_in = $data->teacherIdCode;
        $school->teacher_email = $data->teacherEmail;
        $school->teacher_phone = $data->teacherPhone;

        $school->is_concertmaster = ($data->concertName == '') ? 1 : 0;
        $school->concertmaster_name = $data->concertSurname;
        $school->concertmaster_surname = $data->concertName;
        $school->concertmaster_patronymic = $data->concertPatronymic;
        $school->application_id = $app->application_id;
        $school->save();

        $presentation->composition_one = $data->compositionName;
        $presentation->author_one = $data->compositionAuthor;
        $presentation->time_one = $data->timing1;
        $presentation->composition_two = $data->compositionName2;
        $presentation->author_two = $data->compositionAuthor2;
        $presentation->time_two = $data->timing2;
        $presentation->application_id = $app->application_id;
        foreach($request->files as $k => $val) {
            $composition_video = time().'-'.$val["compositionVideo"]->getClientOriginalName();
            $val["compositionVideo"]
                ->move(public_path().$this
                ->publicStorage, $composition_video);
            $presentation->video = $composition_video;
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
        $model = Application::with('soloDuet', 'group', 'presentation')->find($id);
        if(!$model->group){
            for($i = 0; $i < count($model->soloDuet); $i++) {
                unlink(public_path($this->publicStorage.$model->soloDuet[$i]["passport_photo"]));
                unlink(public_path($this->publicStorage.$model->soloDuet[$i]["in_file"]));
            }
        } else {
            unlink(public_path($this->publicStorage.$model->group["file"]));
        }
        unlink(public_path($this->publicStorage.$model->presentation["video"]));
        $model->delete();
    }
}
