<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';
    protected $primaryKey = 'evaluations_id';

    /**
     * Get the application that owns the evaluation
     */
    public function app()
    {
        return $this->belongsTo('App\Models\Application', 'application_id');
    }

    /**
     * Get the user that owns the evaluation
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id');
    }
}
