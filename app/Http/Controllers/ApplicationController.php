<?php

namespace App\Http\Controllers;
use PDF;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Evaluation;
use App\Models\GroupPeople;
use App\Models\ApplicationType;
use App\Models\SoloDuet;
use App\Models\Preparation;
use App\Models\Presentation;
use App\Models\Nomination;
use App\Models\UserMessages;
use App\Models\Period;
use Illuminate\Support\Facades\Session;
use App\Mail\MemberEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\Users;

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
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation', 'nomination', 'evaluations')->where('status', '!=', 'archive')->get();


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

     public function getArciveMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'presentation', 'nomination')->where('status', '=', 'archive')->get();
         return response()->json($data);
     }

     public function getApprovedMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation', 'nomination')
            ->approved()
            ->get();
         return response()->json($data);
     }

     public function getMember($id)
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation', 'nomination')->where('application_id', '=', $id)->first();
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
        $titleMessage = 'Заявка на участь в конкурсі JazzVitrage';

        $data = json_decode($request->data);

        $app->nomination_id = $data->nomination;
        $app->application_type_id = $data->appType;
        $app->age_category = $data->nameAgeCategory;
        $app->status = Application::CREATED;
        $app->save();
        $app->check = $request->checkFile->store($this->publicStorage.$app->application_id);
        $app->save();

        if($data->appType == 1) {
            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName;
            $soloDuet->surname = $data->memberSurname;
            $soloDuet->patronymic = $data->memberPatronymic;
            $soloDuet->data_birthday = $data->memberDate;
            $soloDuet->member_address = $data->memberAddress;
            $soloDuet->member_email = $data->memberEmail;
            $soloDuet->parent_name = $data->parentName;
            $soloDuet->parent_surname = $data->parentSurname;
            $soloDuet->parent_patronymic = $data->parentPatronymic;
            $soloDuet->in = $data->idCode;
            $soloDuet->is_duet = 0;
            $soloDuet->application_id = $app->application_id;
            $soloDuet->passport_data = $data->passportData;
            $soloDuet->passport_photo = $request->memberBirthdayFile->store($this->publicStorage.$app->application_id);
            $soloDuet->in_file = $request->idFile->store($this->publicStorage.$app->application_id);
            $soloDuet->save();
            $this->sendMailMember('application_accepted', $titleMessage, $soloDuet);
        }

        if($data->appType == 2) {
            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName;
            $soloDuet->surname = $data->memberSurname;
            $soloDuet->patronymic = $data->memberPatronymic;
            $soloDuet->member_address = $data->memberAddress;
            $soloDuet->member_email = $data->memberEmail1;
            $soloDuet->data_birthday = $data->memberDate;
            $soloDuet->parent_name = $data->parentName;
            $soloDuet->parent_surname = $data->parentSurname;
            $soloDuet->parent_patronymic = $data->parentPatronymic;
            $soloDuet->in = $data->idCode;
            $soloDuet->is_duet = 1;
            $soloDuet->application_id = $app->application_id;
            $soloDuet->passport_data = $data->passportData;
            $soloDuet->passport_photo = $request->memberBirthdayFile->store($this->publicStorage.$app->application_id);
            $soloDuet->in_file = $request->idFile->store($this->publicStorage.$app->application_id);
            $soloDuet->save();
            $this->sendMailMember('application_accepted', $titleMessage, $soloDuet);

            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName2;
            $soloDuet->surname = $data->memberSurname2;
            $soloDuet->patronymic = $data->memberPatronymic2;
            $soloDuet->member_email = $data->memberEmail2;
            $soloDuet->member_address = $data->memberAddress2;
            $soloDuet->data_birthday = $data->memberDate2;
            $soloDuet->parent_name = $data->parentName2;
            $soloDuet->parent_surname = $data->parentSurname2;
            $soloDuet->parent_patronymic = $data->parentPatronymic2;
            $soloDuet->in = $data->idCode2;
            $soloDuet->is_duet = 1;
            $soloDuet->application_id = $app->application_id;
            $soloDuet->passport_data = $data->passportData2;
            $soloDuet->passport_photo = $request->member2BirthdayFile->store($this->publicStorage.$app->application_id);
            $soloDuet->in_file = $request->idFile2->store($this->publicStorage.$app->application_id);
            $soloDuet->save();
            $this->sendMailMember('application_accepted', $titleMessage, $soloDuet);
        }

        if($data->appType > 2) {
            $group = new GroupPeople;
            $group->application_id = $app->application_id;
            $group->name = $data->groupName;
            $group->count_people = $data->groupCount;
            $group->average_age = $data->groupAverage;
            $group->file = $request->groupBirthdayFile->store($this->publicStorage.$app->application_id);
            $group->save();
            $this->sendMailGroup('application_accepted', $titleMessage, $group->name, $data->teacherEmail);
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
        $school->teacher_passport_data = $data->teacherPassportData;
        $school->teacher_address = $data->teacherAddress;
        $school->teacher_passport = $request->teacherPassport->store($this->publicStorage.$app->application_id);

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

        $name = time() . '-' . $request->compositionVideo->getClientOriginalName();
        $request->compositionVideo->move(public_path() . '/memberFiles/', $name);
        $presentation->video = '/memberFiles/' . $name;

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

    // Відправка учасника в архів

    function unarchiveMembers($id) {
        $model = Application::find($id);
        $model->status = Application::CREATED;
        $model->save();
    }

    // Затвердження заявки

    function addApproved($id) {
        $model = Application::with('soloDuet', 'group', 'preparation')->find($id);
        $titleMessage = 'Вашу заявку в конкурсі JazzVitrage затверджено';
        $model->status = Application::APPROVED;
        $model->save();

        if ($model->application_type_id == 1 || $model->application_type_id == 2){
            for($i = 0; $i < count($model->soloDuet); $i++) {
                $this->sendMailMember('application_approved', $titleMessage, $model->soloDuet[$i]);
            }
        } else {
            $this->sendMailGroup('application_approved', $titleMessage, $model->group->name, $model->preparation['teacher_email']);
        }
        return response('ok', 200);
    }

    // Видалення учасника

    function deleteMembers($id, Request $request) {
        $model = Application::with('soloDuet', 'group', 'presentation', 'preparation')->find($id);
        $titleMessage = 'Вашу заявку в конкурсі JazzVitrage відхилено';
        Storage::deleteDirectory("member-files/".$model->application_id);
        unlink(public_path($model->presentation["video"]));

        Evaluation::where("application_id", $id)->delete();

        if ($model->application_type_id == 1 || $model->application_type_id == 2){
            for($i = 0; $i < count($model->soloDuet); $i++) {
                $this->sendMailMember('application_denied', $titleMessage, $model->soloDuet[$i], $request->message);
            }
        } else {
            $this->sendMailGroup('application_denied', $titleMessage, $model->group->name, $model->preparation->teacher_email, $request->message);
        }
        $model->delete();
        return response('ok', 200);
    }


    /**
     * Return all application end calculate rating
     * Return json
     */
    public function getRating() {
        $data = Application::with('appType', 'soloDuet', 'group', 'evaluations', 'nomination')->approved()->get();

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

    // Запрошення на Гала-концерт

    function sendInvitation() {
        $model = Application::with('soloDuet', 'group', 'preparation')->approved()->get();
        $titleMessage = 'Запрошення на Гала-Концерт';
        for($i = 0; $i < count($model); $i++) {
            if ($model[$i]->application_type_id == 1 || $model[$i]->application_type_id == 2){
                for($j = 0; $j < count($model[$i]->soloDuet); $j++) {
                    $this->sendMailMember('invitation', $titleMessage, $model[$i]->soloDuet[$j]);
                }
            } else {
                $this->sendMailGroup('invitation', $titleMessage, $model[$i]->group->name, $model[$i]->preparation->teacher_email);
            }
        }
        return response('ok', 200);
    }

    // Відправка листів

    // Для одного учасника
    function sendMailMember($type, $title, $member, $note = '') {
        $period = Period::find(1);
        $textMessage = UserMessages::where('type', $type)->first();
        $textMessage = $textMessage->text;

        $pib = $member->surname . " " . $member->name . " " . $member->patronymic;
        $email = $member->member_email;

        $textMessage = str_ireplace('[ПІБ]', $pib, $textMessage);
        $textMessage = str_ireplace('[причина вказана адміністратором]', $note, $textMessage);
        $textMessage = str_ireplace('[початок прийому заявок]', $period->start_date, $textMessage);
        $textMessage = str_ireplace('[кінець прийому заявок]', $period->expiration_date, $textMessage);

        Mail::raw(htmlspecialchars_decode($textMessage), function($message) use ($email, $title){
            $message->to($email, '')->subject($title);
            $message->from('jazz@gmail.com', 'JazzVitrage');
        });
    }

    // Для групи
    function sendMailGroup($type, $title, $groupName, $email, $note = '') {
        $period = Period::find(1);
        $textMessage = UserMessages::where('type', $type)->first();
        $textMessage = $textMessage->text;

        $textMessage = str_ireplace('[ПІБ]', $groupName, $textMessage);
        $textMessage = str_ireplace('[причина вказана адміністратором]', $note, $textMessage);
        $textMessage = str_ireplace('[початок прийому заявок]', $period->start_date, $textMessage);
        $textMessage = str_ireplace('[кінець прийому заявок]', $period->expiration_date, $textMessage);

        Mail::raw(htmlspecialchars_decode($textMessage), function($message) use ($email, $title){
            $message->to($email, '')->subject($title);
            $message->from('jazz@gmail.com', 'JazzVitrage');
        });
    }

    // Генерація PDF

    // Загальна відомість членів журі
    function vidomistChlenivZhuriPDF() {
        $nomination = array(
            1 => ['vocal', 'Вокальний жанр'],
            2 => ['instrumental', 'Інструментальний жанр'],
            3 => ['composition', ' Композиція']
        );
        $category = array(
            'junior' => 'молодша',
            'middle' => 'середня',
            'senior' => 'старша'
        );

        $data = [];

        foreach ($nomination as $nominationKey => $nominationValue) {
            foreach ($category as $categoryKey => $categoryValue) {
                $data[$nominationValue[0].'_soloDuet_'.$categoryKey] = Application::with('soloDuet', 'preparation', 'presentation', 'evaluations')
                    ->where('nomination_id', $nominationKey)
                    ->where('application_type_id', '<=', 2)
                    ->where('age_category', $categoryValue)
                    ->approved()
                    ->get();
                $data[$nominationValue[0].'_soloDuet_'.$categoryKey]->category = $categoryValue;
                $data[$nominationValue[0].'_soloDuet_'.$categoryKey]->genre = $nominationValue[1];
                $data[$nominationValue[0].'_soloDuet_'.$categoryKey]->type = 'soloDuet';
            }
        }

        foreach ($nomination as $nominationKey => $nominationValue) {
            foreach ($category as $categoryKey => $categoryValue) {
                $data[$nominationValue[0].'_group_'.$categoryKey] = Application::with('group', 'preparation', 'presentation', 'evaluations')
                    ->where('nomination_id', $nominationKey)
                    ->where('application_type_id', '>', 2)
                    ->where('age_category', $categoryValue)
                    ->approved()
                    ->get();
                $data[$nominationValue[0].'_group_'.$categoryKey]->category = $categoryValue;
                $data[$nominationValue[0].'_group_'.$categoryKey]->genre = $nominationValue[1];
                $data[$nominationValue[0].'_group_'.$categoryKey]->type = 'group';
            }
        }

        $jury = Users::where('role', 'jury')->get();

        $pdf = PDF::loadView('pdf.zahalna_vidomist_chleniv_zhuri', [
            'data' => $data,
            'jury' => $jury
        ])->setPaper('a4', 'landscape');
        return $pdf->stream('Загальна_відомість_членів_журі.pdf');
    }

    // Відомість джаз вітраж
    function vidomistDzhazVitrazhPDF() {
        $data = Application::with('soloDuet', 'group', 'preparation', 'presentation')
            ->approved()
            ->get();
        $pdf = PDF::loadView('pdf.vidomist_dzhaz_vitrazh', ['data' => $data]);
        return $pdf->download('Відомість_джаз_вітраж.pdf');
    }

    function listMembersPDF() {
        $data = Application::with('soloDuet', 'group', 'preparation')
            ->approved()
            ->get();
        $pdf = PDF::loadView('pdf.list_members', ['data' => $data]);
        return $pdf->stream('Список_учасників.pdf');
    }
}
