<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlateNumber extends Model
{
    protected $table = 'plate_number';

    protected $fillable = [
        'id', 'driver_id', 'number_plate','status'
    ];


    public function drivers(){
    	return $this->belongsTo(Driver::class);
    }

    public function invoices(){
    	return $this->hasOne(Invoice::class, 'plate_number_id', 'id');
    }

    public function Trackinginfos(){
    	return $this->hasOne(Trackinginfo::class, 'plate_number_id', 'id');
    }

    public function lorrys()
    {
        return $this->hasOne(Lorry::class, 'id', 'lorry_type_id');
    }
}
