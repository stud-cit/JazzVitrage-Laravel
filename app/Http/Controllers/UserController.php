<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userStorage = '/img/user-photo/';

    public function getAllJury()
    {
        $data = Users::where('role', 'jury')->get();
        return response()->json($data);
    }
    public function getAllOrg()
    {
        $data = Users::where('role', 'orgComittee')->get();
        return response()->json($data);
    }
    public function getAllAdmin()
    {
        $data = Users::where('role', 'admin')->get();
        return response()->json($data);
    }
    public function postJury(Request $request)
    {
        $jury_data = new Users;
        $jury_data->role = 'jury';
        $jury_data->name = $request->name;
        $jury_data->surname = $request->surname;
        $jury_data->patronymic = $request->patronymic;
        $jury_data->password = Hash::make('password');
        $file = $request->photo;
        $name = time().'-'.$file->getClientOriginalName();
        $file->move(public_path().$this->userStorage, $name);
        $jury_data->photo = $name;
        $jury_data->email = $request->email;
        $jury_data->rank = $request->rank;
        $jury_data->nominations = $request->nominations;
        $jury_data->informations = $request->informations;
        $jury_data->save();
    }
    public function postOrg(Request $request)
    {
        $org_data = new Users;
        $org_data->role = 'orgComittee';
        $org_data->name = $request->name;
        var_dump($request->name);

        $org_data->surname = $request->surname;
        var_dump($request->surname);

        $org_data->patronymic = $request->patronymic;
        var_dump($request->patronymic);

        $org_data->password = Hash::make('password');
        
        $file = $request->photo;
        $name = time().'-'.$file->getClientOriginalName();
        $file->move(public_path().$this->userStorage, $name);
        $org_data->photo = $name;
        var_dump($name);

        $org_data->email = $request->email;
        var_dump($request->email);

        $org_data->informations = $request->informations;
        var_dump($request->informations);

        $org_data->save();
    }
    public function postAdmin(Request $request)
    {
        $admin_data = new Users;
        $admin_data->role = 'admin';
        $admin_data->name = $request->name;
        $admin_data->surname = $request->surname;
        $admin_data->password = Hash::make('password');
        $admin_data->email = $request->email;
        $admin_data->save();
    }
    public function deleteUser($id)
    {
        $user = Users::find($id);
        if($user->photo != ''){
            unlink(public_path($this->userStorage.$foto->file));
        }
        $user->delete();
    }
}
