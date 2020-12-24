<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table='offers';
    protected $fillable = ['name', 'price', 'details'];
    protected $hidden = []; // ignoring specific columns during data fetching

}
