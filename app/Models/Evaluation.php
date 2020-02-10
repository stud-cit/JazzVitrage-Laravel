<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';
    protected $primaryKey = 'evaluations_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id',
        'user_id',
        'evaluation',
        'stylistic_matching',
        'artistic_value',
        'artistry',
        'originality',
        'recommendation'
    ];

    /**
     * min and max for minor evaluation
     * @var $min
     * @var $max
     */
    public const MIN = 0;
    public const MAX = 25;

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
