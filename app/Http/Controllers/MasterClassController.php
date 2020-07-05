<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\MasterClass;
use App\Models\MasterClassRequest;
use App\Models\UserMessages;
use App\Models\FotoGallery;

class MasterClassController extends Controller
{
    function getInfo() {
        $data = MasterClass::first();
        $photo = FotoGallery::orderBy('year', 'desc')->where('type', 'Мастер клас')->get();
        return response()->json(['info' => $data, 'photo' => $photo]);
    }
    function getPhoto() {
        $data = FotoGallery::orderBy('year', 'desc')->where('type', 'Мастер клас')->get();
        return response()->json($data);
    }
    function putInfo(Request $request) {
        Info::where("id", 1)->update([$request->column => $request->value]);
    }
    function postRequest(Request $request) {
        $model = new MasterClassRequest();
        $data = $request->all();
        $model->create($data);

        $titleMessage = 'Реєстрація на Майстер-клас';
        $textMessage = UserMessages::where('type', 'master_class_register')->first();
        $textMessage = $textMessage->text;

        $pib = $request->name;
        $email = $request->email;

        $textMessage = str_ireplace('[ПІБ]', $pib, $textMessage);

        Mail::raw(htmlspecialchars_decode($textMessage), function($message) use ($email, $titleMessage) {
            $message->to($email, '')->subject($titleMessage);
            $message->from('jazzsumy@gmail.com', 'JazzVitrage');
        });

        return response('ok', 200);
    }
    function getRequest() {
        $data = MasterClassRequest::get();
        return response()->json($data);
    }
    function deleteRequest($id) {
        MasterClassRequest::find($id)->delete();
        return response('ok', 200);
    }
}
