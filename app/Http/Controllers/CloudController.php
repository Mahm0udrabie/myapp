<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class CloudController extends Controller
{
    public function getOffers() {
        return Offer::get();
    }
    public function store() {
        Offer::create([
           'name'   => 'offer 1',
           'price'  => '5000',
            'photo' => 'offer details'
        ]);
    }
}
