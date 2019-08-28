<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoGallery extends Model
{
    protected $table = 'foto_gallery';
    protected $primaryKey = 'foto_id';
    public $incrementing = false;
    protected $fillable = [
        'file', 'type', 'year'
    ];
    protected $guarded = ['foto_id'];
}
