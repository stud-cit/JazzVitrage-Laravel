<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    public const OPEN = true;
    public const CLOSED = false;
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['start_date', 'expiration_date', 'status'];

    public static function isRegistration() {
        $model = Period::find(1);

        $status = $model->status;
        $startDate = strtotime($model->start_date);
        $expiration_date = strtotime($model->expiration_date);
        
        $today = strtotime( date("Y-m-d") );
        
        if ($status) {
            if ($today >= $startDate && $today <= $expiration_date) {
                return true;
            }
            return false;
           
        } else {
            return false;
        }
    }
}
