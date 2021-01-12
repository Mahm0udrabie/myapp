<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation()
    {
        //        $user = user::find(1);
        //        $user = user::with('phone')->find(1);
        $user = User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(1);
        //        return $user-> phone -> code;
        return response()->json($user);
    }
    public function hasOneRelationReverse()
    {
        $phone = Phone::find(1);
        // make attribute visible
        $phone->makeVisible(['user_id']);
        //        $phone -> makeHidden(['code']);
        //        return $phone -> user;
        //        return Phone::with('user')->find(1);
        $phone =  Phone::with(['user' => function ($q) {
            $q->select('id', 'name');
        }])->find(1);
        return $phone;
    }
    public function getUserHasPhone()
    {
        //       return User::WhereHas('phone') -> get();
        //        return User::WhereHas('phone' , function($q) {
        //            $q->where('code', 02);
        //        }) -> get();

    }
    public function getUserNotHasPhone()
    {
        return User::WhereDoesntHave('phone')->get();
    }
    public function getUserHasPhoneWithCondition()
    {
        return User::WhereHas('phone', function ($q) {
            $q->where('code', 025);
        })->get();
    }

    ################# one to many relation methods  #################
    public function getHospitalDoctors()
    {
        $hospital = Hospital::find(1);  // Hospital::where('id',1) -> first();  //Hospital::first();

        // return  $hospital -> doctors;   // return hospital doctors

        $hospital = Hospital::with('doctors')->find(1);

        //return $hospital -> name;


        $doctors = $hospital->doctors;

        /* foreach ($doctors as $doctor){
            echo  $doctor -> name.'<br>';
         }*/

        $doctor = Doctor::find(3);

        return $doctor->hospital->name;
    }
    public function hospitals()
    {
        $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('doctors.hospitals', compact('hospitals'));
    }
    public function doctors($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        $doctors  = $hospital->doctors;
        return view('doctors.doctors', compact('doctors'));
    }
    public function hospitalsHasDoctors()
    {
        $hospitals =  Hospital::whereHas('doctors')->get();
        return $hospitals;
    }
    public function hospitalsHasOnlyMaleDoctors()
    {
        return Hospital::with('doctors')->whereHas('doctors', function ($q) {
            $q->where('gender', 1);
        })->get();
    }
    public function hospitalsDoesNotHaveDoctors()
    {
        return Hospital::WhereDoesntHave('doctors')->get();
    }
    public function deleteHospital($hospital_id)
    {
        $hospital = Hospital::findOrFail($hospital_id);
        if (!$hospital) {
            return abort(404);
        }
        //delete doctors when delete hospitals
        //        $hospital-> doctors -> delete();
        $hospital->delete();
        session()->flash('success', 'Hospital deleted successfully');
        return  redirect()->route('hospitals.all');
    }
    public function getDoctorServices()
    {
        return $doctor = Doctor::with('services')->find(1);
        //        return response() -> json($doctor -> services);
    }
    public function getServicesDoctors()
    {
        return  $services = Service::with(['doctors' => function ($q) {
            $q->select('doctors.id', 'name', 'title');
        }])->find(1);
    }
    public function getDoctorServicesById($id)
    {
        $doctor = Doctor::find($id);
        $services = $doctor->services;
        $doctors   = Doctor::select('id', 'name')->get();
        $allServices = Service::select('id', 'name')->get();
        return view('doctors.services', compact('services', 'doctors', 'allServices'));
    }
    public function saveServicesToDoctors(Request $request)
    {
        $doctor = Doctor::find($request->doctor_id);
        if (!$doctor)
            return abort(404);
        // $doctor -> services() ->attach($request -> servicesIds);
        $doctor->services()->sync($request->servicesIds);
        // $doctor -> services() ->syncwithoutDetaching($request -> servicesIds);
        session()->flash('success', 'Service added successfully');
        return redirect()->back();
    }
    ###### has one through ######
    public function getPateintDoctor()
    {
        $patient =  Patient::find(2);
        return $patient->doctor;
    }
    ###### has many through ######
    public function getCountryDoctor()
    {
        // Country::with('hospitals')->find(1);
        // $countries = Country::with('hospitals')->get();
        // return $countries;

        $countries = Country::with('doctors')->find(1);
        return $countries;
    }
     
}
