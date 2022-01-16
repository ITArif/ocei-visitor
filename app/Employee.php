<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';

    public function designations(){
        return $this->hasMany('App\Designation','designation_id','designation_id');
    }
}
