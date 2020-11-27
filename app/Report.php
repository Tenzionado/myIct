<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    public function department(){
        return $this->belongsTo('App\Department','department_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id', 'id');
    }

    public static function getAllCanceled(){
        return Report::where('status', 3)->paginate(10);
    }
    public static function getAllDone(){
        return Report::where('status', 2)->paginate();
    }

}
