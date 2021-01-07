<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table    = 'phones';
    protected $fillable = ['code','phone', 'user_id'];
    protected $hidden   = ['user_id'];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
