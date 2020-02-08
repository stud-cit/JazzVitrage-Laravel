<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Nomination;

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
    public function getJuryNomination($id)
    {
        $nomination = Nomination::where('nomination_id', '=', $id)->get();
        foreach($nomination as $nom_name)
        {
            $data = Users::orderBy('created_at', 'asc')->where('nominations', '=', $nom_name->name)->get();
            return response()->json($data);
        }
    }
    public function jury($id)
    {
        $data = Users::where('user_id', '=', $id)->get();
        return response()->json($data);
    }
}
