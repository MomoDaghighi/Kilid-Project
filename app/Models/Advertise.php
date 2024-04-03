<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'user_id',
        'city_id',
        'area',
        'price',
        'rent',
        'meter',
        'type',
        'room',
        'title',
        'description',
        'images',
        'status'
    ];

    public function city()
    {
        return $this->BelongsTo(City::class);
    }

    public function agency()
    {
        return $this->BelongsTo(Agency::class);
    }

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function conditions()
    {
        return $this->hasMany(Condition::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function checkcondition($param)
    {
        $exist = Condition::where('advertise_id',$this->id)->where('condition',$param)->first();
        if ($exist) {
            return 'selected';
        } else {
            return '';
        }
    }

    public function checkoption($param)
    {
        $exist = Option::where('advertise_id',$this->id)->where('option',$param)->first();
        if ($exist) {
            return 'selected';
        } else {
            return '';
        }
    }

    public function scopeFilter($query)
    {
        $typee = request('typee');
        if(isset($typee) && trim($typee) != '') {
                $query->where('type',$typee);
        }

        // $area = request('area');
        // if(isset($area) && trim($area) != '') {
        //         $query->where('type',$area);
        // }

        $type = request('type');
        if(isset($type) && trim($type) != '') {
                $query->where('status',$type);
        }

        $type = request('type');
        if(isset($type) && trim($type) != '') {
                $query->where('status',$type);
        }

        $room = request('room');
        if(isset($room) && trim($room) != '') {
                $query->where('room',$room);
        }

        return $query;

    }

    

}
