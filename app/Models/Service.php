<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name'];
    protected $hidden   = ['created_at', 'updated_at', 'pivot'];

    public function doctors() {
        return $this->belongsToMany('App\Models\Doctor', 'doctor_services','service_id','doctor_id','id','id');
    }
}
