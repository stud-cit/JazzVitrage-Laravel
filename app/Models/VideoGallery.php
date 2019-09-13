<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    protected $table = 'video_gallery';
    protected $primaryKey = 'video_id';
    public $incrementing = false;
    protected $fillable = [
        'url'
    ];
    protected $guarded = ['video_id'];
}
