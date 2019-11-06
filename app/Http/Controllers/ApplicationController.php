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
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    protected $publicStorage = "member-files/";

    public function index()
    {	
        return view('application');
    }

    public function download($id, $file)
    {
        return Storage::download($this->publicStorage.$id."/".$file);
    }

     public function getMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation', 'nomination')->where('status', '=', 'created')->get();
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

     public function getApprovedMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation', 'nomination')->where('status', '=', 'approved')->get();
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
        $app->status = Application::CREATED;
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
            $soloDuet->passport_photo = $request->memberBirthdayFile->store($this->publicStorage.$app->application_id);
            $soloDuet->in_file = $request->idFile->store($this->publicStorage.$app->application_id);
            
            // Mail::send(['text' => 'mail'], ['name' => 'jazz', 'soloDuet' => $soloDuet], function($message) use ($soloDuet){
            //     $message->to($soloDuet->member_email, 'test')->subject('заявка JazzVitrage');
            //     $message->from('jazz@gmail.com', 'jazz');
            // });

            $soloDuet->save();
        }
        
        if($data->appType == 2) {
            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName;
            $soloDuet->surname = $data->memberSurname;
            $soloDuet->patronymic = $data->memberPatronymic;
            $soloDuet->member_email = $data->memberEmail1;
            $soloDuet->data_birthday = date("Y-m-d", strtotime($data->memberDate));
            $soloDuet->member_email = $data->memberEmail1;
            $soloDuet->parent_name = $data->parentName;
            $soloDuet->parent_surname = $data->parentSurname;
            $soloDuet->parent_patronymic = $data->parentPatronymic;
            $soloDuet->in = $data->idCode;
            $soloDuet->is_duet = 1;
            $soloDuet->application_id = $app->application_id;
            $soloDuet->passport_photo = $request->memberBirthdayFile->store($this->publicStorage.$app->application_id);
            $soloDuet->in_file = $request->idFile->store($this->publicStorage.$app->application_id);

            // Mail::send(['text' => 'mail'], ['name' => 'jazz', 'soloDuet' => $soloDuet], function($message) use ($soloDuet){
            //     $message->to($soloDuet->member_email, 'test')->subject('заявка JazzVitrage');
            //     $message->from('jazz@gmail.com', 'jazz');
            // });

            $soloDuet->save();

            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName2;
            $soloDuet->surname = $data->memberSurname2;
            $soloDuet->patronymic = $data->memberPatronymic2;
            $soloDuet->member_email = $data->memberEmail2;
            $soloDuet->data_birthday = date("Y-m-d", strtotime($data->memberDate2));
            $soloDuet->member_email = $data->memberEmail2;
            $soloDuet->parent_name = $data->parentName2;
            $soloDuet->parent_surname = $data->parentSurname2;
            $soloDuet->parent_patronymic = $data->parentPatronymic2;
            $soloDuet->in = $data->idCode2;
            $soloDuet->is_duet = 1;
            $soloDuet->application_id = $app->application_id;
            $soloDuet->passport_photo = $request->member2BirthdayFile->store($this->publicStorage.$app->application_id);
            $soloDuet->in_file = $request->idFile2->store($this->publicStorage.$app->application_id);

            // Mail::send(['text' => 'mail'], ['name' => 'jazz', 'soloDuet' => $soloDuet], function($message) use ($soloDuet){
            //     $message->to($soloDuet->member_email, 'test')->subject('заявка JazzVitrage');
            //     $message->from('jazz@gmail.com', 'jazz');
            // });

            $soloDuet->save();
        }

        if($data->appType > 2) {
            $group = new GroupPeople;
            $group->application_id = $app->application_id;
            $group->name = $data->groupName;
            $group->count_people = $data->groupCount;
            $group->average_age = $data->groupAverage;
            $group->file = $request->groupBirthdayFile->store($this->publicStorage.$app->application_id);

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

        $file = $request->compositionVideo->store('public');
        $presentation->video = str_replace('public/', '', $file);

        $presentation->save();

        return response('ok', 200);
     }

    public function archiveMembers($id)
    {
        $model = Application::find($id);

        $model->status = Application::ARCHIVE;

        if($model->save()){
            return 'ok';
        }

    }
    public function unarchiveMembers($id)
    {
        $model = Application::find($id);

        $model->status = Application::CREATED;

        if($model->save()){
            return ;
        }

    }
    public function addApproved($id)
    {
        $model = Application::find($id);

        $model->status = Application::APPROVED;

        if($model->save()){
            return ;
        }

    }
    public function deleteMembers($id)
    {
        $model = Application::with('soloDuet', 'group', 'presentation')->find($id);
        Storage::deleteDirectory("member-files/".$model->application_id);
        Storage::delete("public/".$model->presentation["video"]);
        Evaluation::where("application_id", $id)->delete();
        $model->delete();
        return response('ok', 200);
    }


    /**
     * Return all application end calculate rating
     * Return json
     */
    public function getRating() {
        $data = Application::with('appType', 'soloDuet', 'group', 'evaluations')->approved()->get();
        
        // Rating calculation
        $rating = []; 
        foreach ($data->modelKeys() as $key => $value) {
            
            $allEvaluations = Evaluation::where('application_id', $value)->get()->toArray();
            
            $colEvaluation = array_column($allEvaluations, 'evaluation');
            
            $leng = count($colEvaluation);
            if ($leng > 0) {
                $sum =  array_sum($colEvaluation);
                $resultRate = $sum / $leng;
                $rating[$key]['rating'] = number_format($resultRate, 2, ',', ' ');   
            } else {
                $rating[$key]['rating'] = NULL;
            }  
        }

        // Convert need for array_map
        $convertedData = $data->toArray();

        $dataWithRating = array_map(function($dataRow, $ratingRow) {
            return array_merge($dataRow, $ratingRow);
        }, $convertedData, $rating);

        return response()->json($dataWithRating);
    }
}
