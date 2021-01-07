<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOffersRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
class AjaxController extends Controller
{
    use OfferTrait;
    public function create() {
        // add offer
        return view('ajax_offers.create');
    }
    public function store(OfferRequest $request) {
        //save offer with ajax
        $filename = $this->saveImage($request -> image, 'images/offers');
        $offer = Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'image' => $filename,
            'lang' => $request->lang
        ]);
        if($offer) {
        return response() ->json([
            'status' => true,
            'msg' =>    "success"
            ]);
        } else {
            return response() ->json([
            'status' => false,
            'msg'    => "failed"
            ]);
        }

    }
    public function all() {
        $offers = Offer::select('id', 'name', 'price', 'image','details')->get();
//            return view('offers.all')->with('offers', $offers);
        return view('ajax_offers.all', compact('offers'));
    }
    public function edit($id) {
        $edit_offers = Offer::find($id);
        return view('ajax_offers.create')->with('edit_offers', $edit_offers);
    }
    public function update(Request $request,  $id) {
//        dd($request->all());
        $offer = Offer::findOrFail($id);
        $filename = $this->saveImage($request -> image, 'images/offers');
        $update = $offer->update([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'image' => $filename,
            'lang' => $request->lang
        ]);
        if($update) {
                return response() ->json([
                    'status' => true,
                    'msg' =>   "Offer Successfully Updated"
                ]);
            } else {
                return response() ->json([
                    'status' => false,
                    'msg-d'    => "Failed to update"
                ]);
            }
    }
    public function delete(Request $request) {
//        return $request;
        $delete = Offer::find($request->id)->delete();
        if($delete) {
            return response()->json([
                'status' => true,
                'msg' => 'Successfully Deleted',
                'id' => $request->id
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'failed'
            ]);
        }

    }
}
