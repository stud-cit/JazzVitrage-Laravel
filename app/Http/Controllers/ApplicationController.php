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
use App\Models\Teachers;
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
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation', 'nomination', 'teachers')->where('status', '=', 'created')->get();
         return response()->json($data);
     }

     public function getAllMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation', 'nomination', 'evaluations', 'teachers')->where('status', '!=', 'archive')->get();


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
         $data = Application::with('appType', 'soloDuet', 'group', 'presentation', 'preparation', 'nomination', 'teachers')->where('status', '=', 'archive')->get();
         return response()->json($data);
     }

     public function getApprovedMembers()
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation', 'nomination', 'teachers')
            ->approved()
            ->get();
         return response()->json($data);
     }

     public function getMember($id)
     {
         $data = Application::with('appType', 'soloDuet', 'group', 'preparation', 'presentation', 'nomination', 'teachers')->where('application_id', '=', $id)->first();
         return response()->json($data);
     }

     public function getNominations()
     {
        $data = Nomination::orderBy('created_at', 'asc')->get();
        return response()->json($data);
     }

     public function postApp(Request $request) {
        $app = new Application;
        $presentation = new Presentation;
        $titleMessage = 'Заявка на участь в конкурсі JazzVitrage';

        $data = json_decode($request->data);

        $app->nomination_id = $data->nomination;
        $app->application_type_id = $data->appType;
        $app->age_category = $data->nameAgeCategory;
        $app->status = Application::CREATED;
        $app->save();
        // $app->check = $request->checkFile->store($this->publicStorage.$app->application_id);
        // $app->save();

        if($data->appType == 1) {
            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName;
            $soloDuet->surname = $data->memberSurname;
            $soloDuet->patronymic = $data->memberPatronymic;
            $soloDuet->data_birthday = $data->memberDate;
            $soloDuet->member_address = $data->memberAddress;
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

            for($i = 0; $i < count($data->teachers); $i++) {
                $teachersModel = new Teachers();
                $teacher = (array) $data->teachers[$i];
                if(gettype($request[$data->teachers[$i]->teacher_passport_index]) == "object") {
                    $teacher['teacher_passport'] = $request[$data->teachers[$i]->teacher_passport_index]->store($this->publicStorage.$app->application_id);
                } else {
                    $teacher['teacher_passport'] = null;
                }
                $teacher['application_id'] = $app->application_id;
                $response = $teachersModel->create($teacher);
                $this->sendMail('soloDuet', 'application_accepted', $titleMessage, $response);
            }

        }

        if($data->appType == 2) {
            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName;
            $soloDuet->surname = $data->memberSurname;
            $soloDuet->patronymic = $data->memberPatronymic;
            $soloDuet->member_address = $data->memberAddress;
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

            $soloDuet = new SoloDuet;
            $soloDuet->name = $data->memberName2;
            $soloDuet->surname = $data->memberSurname2;
            $soloDuet->patronymic = $data->memberPatronymic2;
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

            for($i = 0; $i < count($data->teachers); $i++) {
                $teachersModel = new Teachers();
                $teacher = (array) $data->teachers[$i];
                if(gettype($request[$data->teachers[$i]->teacher_passport_index]) == "object") {
                    $teacher['teacher_passport'] = $request[$data->teachers[$i]->teacher_passport_index]->store($this->publicStorage.$app->application_id);
                } else {
                    $teacher['teacher_passport'] = null;
                }
                $teacher['application_id'] = $app->application_id;
                $response = $teachersModel->create($teacher);
                $this->sendMail('soloDuet', 'application_accepted', $titleMessage, $response);
            }

        }

        if($data->appType > 2) {
            $group = new GroupPeople;
            $group->application_id = $app->application_id;
            $group->name = $data->groupName;
            $group->count_people = $data->groupCount;
            $group->average_age = $data->groupAverage;
            $group->file = $request->groupBirthdayFile->store($this->publicStorage.$app->application_id);
            $group->save();

            for($i = 0; $i < count($data->teachers); $i++) {
                $teachersModel = new Teachers();
                $teacher = (array) $data->teachers[$i];
                if(gettype($request[$data->teachers[$i]->teacher_passport_index]) == "object") {
                    $teacher['teacher_passport'] = $request[$data->teachers[$i]->teacher_passport_index]->store($this->publicStorage.$app->application_id);
                } else {
                    $teacher['teacher_passport'] = null;
                }
                $teacher['application_id'] = $app->application_id;
                $response = $teachersModel->create($teacher);
                $this->sendMail('group', 'application_accepted', $titleMessage, $response);
            }
        }

        $preparationModel = new Preparation();
        $preparation = (array) $data->school;
        $preparation['application_id'] = $app->application_id;
        $preparationModel->create($preparation);

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
        $model = Application::with('soloDuet', 'group', 'preparation', 'teachers')->find($id);
        $titleMessage = 'Вашу заявку в конкурсі JazzVitrage затверджено';
        $model->status = Application::APPROVED;
        $model->save();

        if ($model->application_type_id == 1 || $model->application_type_id == 2){
            for($i = 0; $i < count($model->teachers); $i++) {
                $this->sendMail('soloDuet', 'application_approved', $titleMessage, $model->teachers[$i]);
            }
        } else {
            for($i = 0; $i < count($model->teachers); $i++) {
                $this->sendMail('group', 'application_approved', $titleMessage, $model->teachers[$i]);
            }
        }
        return response('ok', 200);
    }

    // Видалення учасника

    function deleteMembers($id, Request $request) {
        $model = Application::with('soloDuet', 'group', 'presentation', 'preparation', 'teachers')->find($id);
        $titleMessage = 'Вашу заявку в конкурсі JazzVitrage відхилено';
        Storage::deleteDirectory("member-files/".$model->application_id);
        if(file_exists(public_path($model->presentation["video"]))) {
            unlink(public_path($model->presentation["video"]));
        }

        Evaluation::where("application_id", $id)->delete();

        if ($model->application_type_id == 1 || $model->application_type_id == 2){
            for($i = 0; $i < count($model->teachers); $i++) {
                $this->sendMail('soloDuet', 'application_denied', $titleMessage, $model->teachers[$i], $request->message);
            }
        } else {
            for($i = 0; $i < count($model->teachers); $i++) {
                $this->sendMail('group', 'application_denied', $titleMessage, $model->teachers[$i], $request->message);
            }
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

            $colRecommendation = array_column($allEvaluations, 'recommendation');

            $rating[$key]['recommendation'] = array_sum($colRecommendation);

            $leng = count($colEvaluation);
            if ($leng > 0) {
                $sum =  array_sum($colEvaluation);
                $resultRate = $sum / $leng;
                $rating[$key]['rating'] = $resultRate;
            } else {
                $rating[$key]['rating'] = 0;
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
        $model = Application::with('soloDuet', 'group', 'preparation', 'teachers')->approved()->get();
        $titleMessage = 'Запрошення на Гала-Концерт';
        for($i = 0; $i < count($model); $i++) {
            if ($model[$i]->application_type_id == 1 || $model[$i]->application_type_id == 2){
                for($j = 0; $j < count($model[$i]->teachers); $j++) {
                    $this->sendMail('soloDuet', 'invitation', $titleMessage, $model[$i]->teachers[$j]);
                }
            } else {
                for($j = 0; $j < count($model[$i]->teachers); $j++) {
                    $this->sendMail('group', 'invitation', $titleMessage, $model[$i]->teachers[$j]);
                }
            }
        }
        return response('ok', 200);
    }

    // Відправка листів

    function sendMail($typeMember, $type, $title, $teacher, $note = '') {
        $model = Application::with($typeMember)->get();
        $period = Period::find(1);
        $textMessage = UserMessages::where('type', $type)->first();
        $textMessage = $textMessage->text;

        $textMessage = str_ireplace('[ПІБ]', $teacher->teacher_surname." ".$teacher->teacher_name." ".$teacher->teacher_patronymic, $textMessage);
        $textMessage = str_ireplace('[причина вказана адміністратором]', $note, $textMessage);
        $textMessage = str_ireplace('[початок прийому заявок]', $period->start_date, $textMessage);
        $textMessage = str_ireplace('[кінець прийому заявок]', $period->expiration_date, $textMessage);

        $email = $teacher->teacher_email;

        Mail::raw(htmlspecialchars_decode($textMessage), function($message) use ($email, $title){
            $message->to($email, '')->subject($title);
            $message->from('jazz@gmail.com', 'JazzVitrage');
        });

        // повідомлення керівництву
        // $textGeneralMessage = 'Створена нова заявка на участь у конкурсі';
        // $generalEmail = 'jazzsumy@gmail.com';

        // for($i = 0; $i < count($model); $i++) {
        //     if ($model[$i]->application_type_id > 2 && $model[$i]->application_id == $groupName->application_id) {
        //         $number_aplication = $model[$i]->application_id;
        //         $type = $model[$i]->appType->name;
        //         $nomination = $model[$i]->nomination->name;
        //         //$countSolo = 'Кількість заяв у данній категорії: '.count($model[$i]->soloDuet);

        //         Mail::raw("Номер заявки: " . $number_aplication . "\n" . "Тип заявки: " . $type . "\n" . "Номінація: " . $nomination . "\n", function ($message) use ($generalEmail, $textGeneralMessage) {
        //             $message->to($generalEmail, '')->subject($textGeneralMessage);
        //             $message->from('jazz@gmail.com', 'JazzVitrage');
        //         });
        //     }
        // }
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
                $data[$nominationValue[0].'_soloDuet_'.$categoryKey] = Application::with('soloDuet', 'preparation', 'presentation', 'evaluations', 'teachers')
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
                $data[$nominationValue[0].'_group_'.$categoryKey] = Application::with('group', 'preparation', 'presentation', 'evaluations', 'teachers')
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

        // return response()->json($data);

        $jury = Users::where('role', 'jury')->get();

        $pdf = PDF::loadView('pdf.zahalna_vidomist_chleniv_zhuri', [
            'data' => $data,
            'jury' => $jury
        ])->setPaper('a4', 'landscape');
        return $pdf->stream('Загальна_відомість_членів_журі.pdf');
    }

    // Відомість джаз вітраж
    function vidomistDzhazVitrazhPDF() {
        $data = Application::with('soloDuet', 'group', 'preparation', 'presentation', 'teachers')
            ->approved()
            ->get();
        $pdf = PDF::loadView('pdf.vidomist_dzhaz_vitrazh', ['data' => $data])->setPaper('a4', 'landscape');
        return $pdf->stream('Відомість_джаз_вітраж.pdf');
    }

    function listMembersPDF() {
        $data = Application::with('soloDuet', 'group', 'preparation', 'teachers')
            ->approved()
            ->get();
        $pdf = PDF::loadView('pdf.list_members', ['data' => $data])->setPaper('a4', 'landscape');
        return $pdf->stream('Список_учасників.pdf');
    }

    function сontactMembers() {
        $data = Application::with('soloDuet', 'group', 'preparation', 'teachers')
            ->approved()
            ->get();
        $pdf = PDF::loadView('pdf.сontact_members', ['data' => $data]);
        return $pdf->stream('Контактні_дані.pdf');
    }

    function diploms() {
        $data = Application::with('nomination', 'soloDuet', 'group', 'preparation', 'teachers')
            ->approved()
            ->get();
        // return response()->json($data);
        $pdf = PDF::loadView('pdf.diploms', ['data' => $data]);
        return $pdf->stream('Дипломи.pdf');
    }
}
