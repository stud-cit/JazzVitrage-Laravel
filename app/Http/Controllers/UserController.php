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
    public function updateJury(Request $request, $id)
    {
        $update_jury = Users::find($id);
        $update_jury->role = 'jury';
        $update_jury->name = $request->name;
        $update_jury->surname = $request->surname;
        $update_jury->patronymic = $request->patronymic;
        $file = $request->photo;
        $name = time().'-'.$file->getClientOriginalName();
        $file->move(public_path().$this->userStorage, $name);
        $update_jury->photo = $name;
        $update_jury->email = $request->email;
        $update_jury->rank = $request->rank;
        $update_jury->nominations = $request->nominations;
        $update_jury->informations = $request->informations;
        $update_jury->save();
    }

    public function postOrg(Request $request)
    {
        $org_data = new Users;
        $org_data->role = 'orgComittee';
        $org_data->name = $request->name;
        $org_data->surname = $request->surname;
        $org_data->patronymic = $request->patronymic;
        $org_data->password = Hash::make('password');

        $file = $request->photo;
        $name = time().'-'.$file->getClientOriginalName();
        $file->move(public_path().$this->userStorage, $name);
        $org_data->photo = $name;
        $org_data->email = $request->email;
        $org_data->informations = $request->informations;
        $org_data->save();
    }

    public function updateOrg(Request $request, $id)
    {
        $update_org = Users::find($id);
        $update_org->role = 'orgComittee';
        $update_org->name = $request->name;
        $update_org->surname = $request->surname;
        $update_org->patronymic = $request->patronymic;
        $update_org->password = Hash::make('password');

        $file = $request->photo;
        $name = time().'-'.$file->getClientOriginalName();
        $file->move(public_path().$this->userStorage, $name);
        $update_org->photo = $name;
        $update_org->email = $request->email;
        $update_org->informations = $request->informations;
        $update_org->save();
    }

    public function postAdmin(Request $request)
    {
        $admin_data = new Users;
        $admin_data->role = 'admin';
        $admin_data->name = $request->name;
        $admin_data->surname = $request->surname;
        $admin_data->password = Hash::make('password');
        $admin_data->email = $request->email;
        $admin_data->patronymic = $request->patronymic;
        $admin_data->save();
    }

    public function updateAdmin(Request $request, $id)
    {
        $update_admin = Users::find($id);
        $update_admin->role = 'admin';
        $update_admin->name = $request->name;
        $update_admin->surname = $request->surname;
        $update_admin->password = Hash::make('password');
        $update_admin->email = $request->email;
        $update_admin->save();
    }

    public function editUser(Request $request)
    {
        $admin_data = new Users;
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
            unlink(public_path($this->userStorage.$user->photo));
        }
        $user->delete();
    }
}