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
    public function jury()
    {
        $data = Users::where('role', 'jury')->get();
        return response()->json($data);
    }
}
