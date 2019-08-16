<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPeople extends Model
{
    protected $table = 'group_people';
    protected $primaryKey = 'group_people_id';

    public function app()
	{
		return $this->belongsTo('App\Models\Application', 'application_id');
	}
}
