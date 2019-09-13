<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactsItems extends Model
{
    protected $table = 'contact-items';
    protected $primaryKey = 'contact_items_id';

    public function app()
	{
		return $this->belongsTo('App\Models\Contacts', 'contact_section_id');
	}
}
