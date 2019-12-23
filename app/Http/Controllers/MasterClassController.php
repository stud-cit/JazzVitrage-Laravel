<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterClass;
use App\Models\MasterClassRequest;
use App\Models\FotoGallery;

class MasterClassController extends Controller
{
    function getInfo() {
        $data = MasterClass::first();
        $photo = FotoGallery::where('type', 'Мастер клас')->get();
        return response()->json(['info' => $data, 'photo' => $photo]);
    }
    function putInfo(Request $request) {
        Info::where("id", 1)->update([$request->column => $request->value]);
    }
    function postRequest(Request $request) {
        $model = new MasterClassRequest();
        $data = $request->all();
        $model->create($data);
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
