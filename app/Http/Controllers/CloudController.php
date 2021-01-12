<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Traits\OfferTrait;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Videos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateOffersRequest;
use App\Models\Doctor;
use App\Scope\OfferScope;

class CloudController extends Controller
{
    use OfferTrait;
    public function getOffers()
    {
        return Offer::all();
    }
    public function store(OfferRequest $request)
    {
        //        dd($request->all());
        //        dd($request);
        //        $rules     = $this -> getRuels();
        //        $messages  = $this -> getMessages();
        //        $validator = Validator::make($request->all(), $rules, $messages);
        //        if($validator->fails()) {
        //            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        //        }
        //        $image = $request->image->getClientOriginalExtension();
        //        $fileName = time().".".$image;
        //        $path = 'images/offers';
        //        $request->image ->move($path, $fileName);
        $filename = $this->saveImage($request->image, 'images/offers');
        if (Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'image' => $filename,
            'lang' => $request->lang
        ])) {
            session()->flash('success', __('messages.flash'));
        }
        return redirect(route('offers.create'));
    }
    public function create()
    {
        return view('offers.create');
    }
    public function edit($id)
    {
        $edit_offers = Offer::find($id);
        return view('offers.create')->with('edit_offers', $edit_offers);
    }
    public function update(UpdateOffersRequest $request,  $id)
    {
        $offer = Offer::findOrFail($id);
        $filename = $this->saveImage($request->image, 'images/offers');
        if ($offer->update([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'image' => $filename,
            'lang' => $request->lang
        ])) {
            session()->flash('success', __('messages.update_flash'));
        }
        return redirect(route('offers.all'));
    }
    public function delete($id)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            return redirect()->back()->with(['error' => __('messages.notOffer')]);
        }
        if ($offer->delete()) {
            session()->flash('danger', __('messages.delete_flash'));
        }
        return redirect(route('offers.all'));
    }
    public function getAllOffers()
    {
        // using global scope
        return Offer::get();


        // without global scope

        return Offer::withoutGlobalScope(OfferScope::class)->get();
        $offers = Offer::select(
            'id',
            'name',
            'price',
            'image',
            'details'
        )
            ->paginate(PAGINATION_COUNT);
        // ->get();
        //            return view('offers.all')->with('offers', $offers);
        // return view('offers.all', compact('offers'));
        return view('offers.paginations', compact('offers'));
    }
    public function getVideo()
    {
        $video = Videos::first();
        event(new VideoViewer($video));
        return view('video')->with('video', $video);
    }
    public function get_inactive() {
        //using local scope
    return   $inactiveOffers = Offer::invalid() -> get(); 
    }
    public function getDoctors()
    {
        $doctors = Doctor::select('id', 'name', 'gender') -> get();
        // if(isset($doctors) && $doctors -> count() > 0) {
        //     foreach($doctors as $doctor) {
        //         $doctor -> gender= $doctor -> gender == 1 ? "male" : "female";
        //     }   
        // }
        return $doctors;
    }
}
