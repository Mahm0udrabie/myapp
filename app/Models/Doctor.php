<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Doctor extends Model
{
    protected $table    = "doctors";
    protected $fillable = ['name', 'title', 'hospital_id','gender'];
    protected $hidden  = ['created_at', 'updated_at', 'pivot'];

    public function hospital(){
        return $this -> belongsTo('App\Models\Hospital','hospital_id','id');
    }
    public function services() {
       return $this->belongsToMany('App\Models\Service', 'doctor_services','doctor_id','service_id','id','id');
    }

}
