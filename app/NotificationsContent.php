<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationsContent extends Model
{
    protected $table = "notifications_contents";
    protected $fillable= [ 'lang', 'content', 'symbol'];
}
