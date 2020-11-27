<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Department;
class Department extends Model
{
    //
    public function report(){
        return $this->hasMany('App\Report','department_id', 'id');
    }

    public static function getDepartment(){
        return Department::paginate(5);
    }

}
