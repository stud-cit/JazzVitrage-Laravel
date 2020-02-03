<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preparation extends Model
{
    protected $table = 'preparation';
    protected $primaryKey = 'preparation_id';

    protected $fillable = [
        'school_name',
        'school_address',
        'school_email',
        'school_phone',
        'concertmaster_name',
        'concertmaster_surname',
        'concertmaster_patronymic',
        'application_id'
    ];

    public function app()
	{
		return $this->belongsTo('App\Models\Application', 'application_id');
	}
}
