<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    protected $table = 'presentation';
    protected $primaryKey = 'presentation_id';
    
    public function app()
	{
		return $this->belongsTo('App\Models\Application', 'application_id');
	}
}
