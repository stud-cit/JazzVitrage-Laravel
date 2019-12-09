<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'role',
        'email',
        'password',
        'name',
        'surname',
        'patronymic',
        'photo',
        'rank',
        'nominations',
        'informations'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guarded = ['user_id'];

    /**
	 *  Get the evaluations for user
	 */
    public function evaluation()
    {
        return $this->hasMany('App\Models\Evaluation', 'user_id');
    }
}
