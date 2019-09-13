<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $table = 'contact_section';
    protected $primaryKey = 'contact_section_id';

    public function contactsItems()
	{
		return $this->hasMany('App\Models\ContactsItems', 'contact_section_id');
	}
}
