<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserMessages extends Model
{
    protected $table = 'users_messages';
    public $incrementing = false;
    public $timestamps = false;
}