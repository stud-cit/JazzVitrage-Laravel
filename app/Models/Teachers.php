<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';

    protected $fillable = [
        'teacher_name',
        'teacher_surname',
        'teacher_patronymic',
        'teacher_in',
        'teacher_email',
        'teacher_phone',
        'teacher_passport_data',
        'teacher_passport',
        'teacher_address',
        'application_id'
    ];
}
