<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertise;
use App\Models\City;
use App\Models\Option;
use App\Models\Condition;


class AdvertiseController extends Controller
{
    public function searchajax()
    {
        $text = request('text');
        $cities = City::where('name','LIKE','%'.$text.'%')->get();

        $areas1 = [];
        foreach (Advertise::where('area','LIKE','%'.$text.'%')->get() as $item) {
            array_push($areas1,$item->area);
        }

        $areas = array_unique($areas1);
        
        return [$areas,$cities];

    }

    public function index()
    {

        //dd(request('min-meter'));
        $kind = request('kind');
        $type = request('type');
        $name = request('name');

        $min_meter = request('min-meter') != null ? request('min-meter') : 0;
        $max_meter = request('max-meter') != null ? request('max-meter') : 99999999999;
        $options = request('options');
        $conditions = request('conditions');


        if (!request('name') && !request('kind')) {
            $advertises1 = Advertise::latest()->filter()->whereBetween('meter',[$min_meter,$max_meter])->get();
        } else {
            if ($kind == 'area') {
                $advertises1 = Advertise::where('area',$name)->whereBetween('meter',[$min_meter,$max_meter])->filter()->get();
            } else {
                $city = City::wherename($name)->first();
                $advertises1 = Advertise::where('city_id',$city->id)->whereBetween('meter',[$min_meter,$max_meter])->filter()->get();
            }
        }

        $advertises2=[];
        if (isset($options) && trim($options) != '') {
            foreach ($advertises1 as $adver) {
                if (Option::where('advertise_id',$adver->id)->where('option',$options)->first()) {
                    array_push($advertises2,$adver);
                }
            }
        } else {
            foreach ($advertises1 as $adver) {
                    array_push($advertises2,$adver);   
            }
        }

        $advertises3=[];
        if (isset($conditions) && trim($conditions) != '') {
            foreach ($advertises2 as $adver) {
                if (Condition::where('advertise_id',$adver->id)->where('condition',$conditions)->first()) {
                    array_push($advertises3,$adver);
                }
            }
        } else {
            foreach ($advertises2 as $adver) {
                    array_push($advertises3,$adver);   
            }
        }
        
        $advertises = $advertises3;
        

        
        return view('home.advertise.all',compact('advertises'));
        

    }

    public function show(Advertise $advertise)
    {
        return view('home.advertise.show',compact('advertise'));
    }
}
