<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table    = "hospitals";
    protected $fillable = ['name', 'address'];
    protected $hidden  = ['created_at', 'updated_at'];

    public function doctors(){
        return $this -> hasMany('App\Models\Doctor','hospital_id','id');
    }
    public function country() {
        return  $this -> belongsTo('App\Models\Country', 'hospital_id', 'id');
    }
}
