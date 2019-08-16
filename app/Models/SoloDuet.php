<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoloDuet extends Model
{
	protected $table = 'solo_duet';
    protected $primaryKey = 'solo_duet_id';

    public function app()
	{
		return $this->belongsTo('App\Models\Application', 'application_id');
	}
}
