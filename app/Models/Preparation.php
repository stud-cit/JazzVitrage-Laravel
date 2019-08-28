<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preparation extends Model
{
    protected $table = 'preparation';
    protected $primaryKey = 'preparation_id';
    
    public function app()
	{
		return $this->belongsTo('App\Models\Application', 'application_id');
	}
}
