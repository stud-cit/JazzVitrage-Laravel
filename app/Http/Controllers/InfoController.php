<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contacts;
use App\Models\ContactsItems;

class InfoController extends Controller
{
    protected $InfoStorage = '/img';

    public function getAllInfo()
    {
        $info = DB::select('select logo_section.*, position_section.*, hymn_section.* from logo_section, position_section, hymn_section');
        $contact = Contacts::with('contactsItems')->get();
        return response()->json(['info' => $info, 'contact' => $contact]);
    }
    public function postContact(Request $request)
    {
        if($request->id) {
            $contacts = ContactsItems::find($request->id);
        } else {
            $contacts = new ContactsItems;
        }
        $contacts->contact_section_id = $request->contact_section_id;
        $contacts->contact_title = $request->contact_title;
        $contacts->contact = $request->contact;
        $contacts->save();
    }
    public function deleteContact($id)
    {
        $contacts = ContactsItems::find($id);
        $contacts->delete();
    }
    public function postInfo(Request $request)
    {
        $res = DB::update('update '.$request->table.' set '.$request->row.' = "'.html_entity_decode($request->value).'" where id = 1');
    }
    public function postInfoFile(Request $request)
    {
        $name = $request->file->getClientOriginalName();
        $request->file->move(public_path().$this->InfoStorage, $name);
        $res = DB::update('update '.$request->table.' set '.$request->row.' = "'.$name.'" where id = 1');
    }
}
