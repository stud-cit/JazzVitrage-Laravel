<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    protected $table = 'video_gallery';
    protected $primaryKey = 'video_id';

    protected $fillable = [
        'url',
        'year'
    ];
}
