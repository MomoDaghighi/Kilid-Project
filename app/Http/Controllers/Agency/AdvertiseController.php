<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertise;
use App\Models\Option;
use App\Models\Condition;
use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Support\Str;



class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $agency = $user->agency;
        $advertises = Advertise::where('agency_id',$agency->id)->get();
        return view('agency.advertise.all',compact('advertises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agency.advertise.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'city_id' => 'required',
            'area' => 'required',
            'price' => 'required',
           // 'rent' => 'required',
            'meter' => 'required',
            'type' => 'required',
            'room' => 'required',
            'title' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);


        $user = auth()->user();
        $agency = $user->agency;

        $advertise = Advertise::create([
            'user_id'=>$user->id,
            'agency_id'=>$agency->id,
            'city_id'=>$request->city_id,
            'area'=>$request->area,
            'price'=>$request->price,
            'rent'=>$request->rent ?? null,
            'meter'=>$request->meter,
            'type'=>$request->type,
            'room'=>$request->room,
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'images'=>$request->main ?? null,

        ]);

        if ($request->options) {
            foreach ($request->options as $item) {
                Option::create([
                    'advertise_id'=>$advertise->id,
                    'option'=>$item,
                ]);
            }
        }

        if ($request->conditions) {
            foreach ($request->conditions as $item) {
                Condition::create([
                    'advertise_id'=>$advertise->id,
                    'condition'=>$item,
                ]);
            }
        }

        if ($request->images) {
            foreach ($request->images as $item) {
                Gallery::create([
                    'advertise_id'=>$advertise->id,
                    'images'=>$item,
                    'main'=>$request->main == $item ? 'yes' : null,
                ]);
            }
        }

        alert()->success('آگهی مورد نظر ثبت شد');
        return redirect(route('advertises.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertise $advertise)
    {
        return view('agency.advertise.edit',compact('advertise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertise $advertise)
    {
        //dd($request);
        $this->validate($request, [
            'city_id' => 'required',
            'area' => 'required',
            'price' => 'required',
           // 'rent' => 'required',
            'meter' => 'required',
            'type' => 'required',
            'room' => 'required',
            'title' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);


        $user = auth()->user();
        $agency = $user->agency;

        $advertise->update([
            //'user_id'=>$user->id,
            //'agency_id'=>$agency->id,
            'city_id'=>$request->city_id,
            'area'=>$request->area,
            'price'=>$request->price,
            'rent'=>$request->rent ?? null,
            'meter'=>$request->meter,
            'type'=>$request->type,
            'room'=>$request->room,
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'images'=>$request->main ?? null,

        ]);

        foreach ($advertise->options as $item) {
            $item->delete();
        }

        if ($request->options) {
            foreach ($request->options as $item) {
                Option::create([
                    'advertise_id'=>$advertise->id,
                    'option'=>$item,
                ]);
            }
        }

        foreach ($advertise->conditions as $item) {
            $item->delete();
        }

        if ($request->conditions) {
            foreach ($request->conditions as $item) {
                Condition::create([
                    'advertise_id'=>$advertise->id,
                    'condition'=>$item,
                ]);
            }
        }

        foreach ($advertise->galleries as $item) {
            $item->delete();
        }

        if ($request->images) {
            foreach ($request->images as $item) {
                Gallery::create([
                    'advertise_id'=>$advertise->id,
                    'images'=>$item,
                    'main'=>$request->main == $item ? 'yes' : null,
                ]);
            }
        }

        alert()->success('آگهی مورد نظر ویرایش شد');
        return redirect(route('advertises.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request)
    {

        $file = $request->file('images');
        if ($file) {
            $file = $request->file('images');
            $str = Str::random(5);
            $filename = 'file' . $str . $file->getClientOriginalName();
            $destinationPath = '/upload/adver' . 'file' . Carbon::now()->year . '/' . Carbon::now()->month . '/' . Carbon::now()->day . '/';
            $file->move(public_path($destinationPath), $filename);
            $x = $destinationPath . $filename;
        } else {
            $x = null;
        }

        return $x;
    }
}
