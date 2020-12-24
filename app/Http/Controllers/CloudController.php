<?php

namespace App\Http\Controllers;


use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CloudController extends Controller
{
    public function getOffers() {
        return Offer::get();
    }
    public function store(Request $request) {
//        dd($request->all());
        dd($request);
        $rules     = $this -> getRuels();
        $messages  = $this -> getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        Offer::create($request->all());
        return view('offers.create');
    }
    public function create() {
        return view('offers.create');
    }
    protected function getMessages() {
        return [
            'name.required'  => __('messages.offerName'),
            "name.unique" => __("messages.nameExists"),
            'price.required' => __('messages.priceValidate'),
            'price.numeric' => __('messages.priceIsANumber'),
            'details.required' => __("messages.detailsFailed")
        ];
    }
    protected function getRuels() {
    return [
        'name'    => 'required|min:3|max:10|unique:offers,name',
        'price'   => 'required|numeric',
        'details' => 'required'
    ];
}
}
