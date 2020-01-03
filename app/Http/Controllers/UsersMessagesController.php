<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMessages;

class UsersMessagesController extends Controller
{
    function getMessages() {
        $data = UserMessages::get();
        return response()->json($data);
    }
    function putMessage(Request $request) {
        UserMessages::where("type", $request->page)->update(['text' => $request->text]);
        return response('ok', 200);
    }
}
