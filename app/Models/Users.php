<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = false;

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
    protected $guarded = ['user_id'];
}
