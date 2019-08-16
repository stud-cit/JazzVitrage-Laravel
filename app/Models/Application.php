<?php

namespace App\Models;
// use App\Models\ApplicationType;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'application';
    protected $primaryKey = 'application_id';

    public function appType()
	{
		return $this->belongsTo('App\Models\ApplicationType', 'application_type_id');
	}
	public function app()
	{
		return $this->hasOne('App\Models\GroupPeople', 'application_id');
	}
	public function app()
	{
		return $this->hasOne('App\Models\SoloDuet', 'application_id');
	}
}
