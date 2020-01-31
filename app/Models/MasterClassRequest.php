<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterClassRequest extends Model
{
    protected $table = 'master_class_req';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'phone', 'email', 'sity', 'school_address'
    ];
}
