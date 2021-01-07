<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorService extends Model
{
    protected $table = "doctor_services";
    protected $fillable = ['doctor_id', 'service_id'];
    protected $hidden   = ['created_at', 'updated_at'];
}
