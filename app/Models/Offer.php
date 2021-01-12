<?php

namespace App\Models;
use App\Scope\OfferScope;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table='offers';
    protected $fillable = ['name', 'price', 'details', 'image', 'lang','offers'];
    protected $hidden = []; // ignoring specific columns during data fetching

    //register global scope
    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new OfferScope);
    }

    // local scope
    ############### scopes ##############
    public function scopeInactive($query) {
        return $query -> where('status', 0); 
    }
    public function scopeInvalid($query) {
        return $query -> where('status', 0)->whereNull('lang'); 
    }
    ############### scopes ##############
        
    // Laravel Mutators

    public function setNameAttribute($val) {
        return $this-> attributes['name'] = strtoupper($val);
    }

}
