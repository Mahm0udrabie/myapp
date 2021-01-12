<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Scope\OfferScope;

class CollectToutrial extends Controller
{
     public function index()
    {
        $numbers = [1, 2 , 3, 4];
        $col     = collect($numbers);
        // return $col -> avg();
        $names = collect(['name', "age"]);
        // return $res = $names-> combine(['Mahmoud', '25']);

        $ages = collect([1, 2,2 , 3, 4, 7, 5, 5, 6, 3, 7, 8, 9]);
        // return $ages -> count();
        // return $ages -> countBy();
        return $ages -> duplicates();
        //each 
        //search
        //filter
        //transform
    }
    public function complex() {
        $offers =  Offer::withoutGlobalScope(OfferScope::class)->get();
        //remove 
        $offers -> each(function($offer){
            if( $offer -> status == 1) {
                unset($offer -> created_at);
                unset($offer -> updated_at);
            }
            
            $offer -> new_name = "Mahmoud";
            return $offer;
        });
        return $offers; 
    }
    public function complexFilter() {
        $offers =  Offer::withoutGlobalScope(OfferScope::class)->get();
        $offers = collect($offers);
        $res = $offers -> filter(function($value , $key) {
            return $value["lang"] == "ar";
        });
        // return $res;
        return array_values($res -> all());
    }
    public function complexTransform() {
        $offers =  Offer::withoutGlobalScope(OfferScope::class)->get();
        $offers = collect($offers);
        $res = $offers -> transform(function($value , $key) {
            $data = []; 
            $data["name"]     = $value["name"];
            $data['details']  = $value["details"];

            return $data;
        });
        // return $res;
        return array_values($res -> all());
    }
}
