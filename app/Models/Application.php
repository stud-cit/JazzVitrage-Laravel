<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'application';
	protected $primaryKey = 'application_id';
	public const CREATED = 'created';
	public const ARCHIVE = 'archive';
	public const APPROVED = 'approved';
	
    protected $fillable = [
        'nomination_id',
        'application_type_id',
		'age_category',
		'status'
    ];

    public function appType()
	{
		return $this->belongsTo('App\Models\ApplicationType', 'application_type_id');
	}
	public function group()
	{
		return $this->hasOne('App\Models\GroupPeople', 'application_id');
	}
	public function soloDuet()
	{
		return $this->hasMany('App\Models\SoloDuet', 'application_id');
	}
	public function preparation()
	{
		return $this->hasOne('App\Models\Preparation', 'application_id');
	}
	public function presentation()
	{
		return $this->hasOne('App\Models\Presentation', 'application_id');
	}
	public function nomination()
	{
		return $this->belongsTo('App\Models\Nomination', 'nomination_id');
	}
	public function teachers()
	{
		return $this->hasMany('App\Models\Teachers', 'application_id');
	}

	/**
	 *  Get the evaluations for application
	 */
	public function evaluations()
	{
		return $this->hasMany('App\Models\Evaluation', 'application_id');
	}

	/**
	 * Scope a query to only created application.
	 * 
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeCreated($query) {
		return $query->where('status', self::CREATED);
	}

    public function scopeApproved($query) {
        return $query->where('status', self::APPROVED);
    }
}
