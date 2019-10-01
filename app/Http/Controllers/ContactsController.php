<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class ContactsController extends Controller
{
    public function organizingCommittee()
    {
        $data = Users::where('role', 'orgComittee')->get();
        return response()->json($data);
    }
    public function getJurys()
    {
        $data = Users::where('role', 'jury')->get();
        return response()->json($data);
    }
    public function jury($id)
    {
        $data = Users::where('user_id', '=', $id)->get();
        return response()->json($data);
    }
}
