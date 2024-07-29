<?php

namespace App\Models;
use App\Models\Lorry;
use App\Models\Invoice;
use App\Models\PlateNumber;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'id', 'name', 'ic', 'phone', 'plate_number', 'remark',
    ];
    

    // public function lorrys()
    // {
    //     return $this->hasOne(lorry::class, 'id', 'lorry_type_id');
    // }
    
    public function invoices(){
    	return $this->hasMany(Invoice::class);
    }

    public function transporters(){
    	return $this->hasMany(TransporterDetailView::class, 'id', 'driver_id');
    }

    public function platenumbers(){
    	return $this->hasMany(PlateNumber::class);
    }

    public function scopeFindByDriverID($query, $driver_id)
    {
        $query->where('id', $driver_id);
    }
    public function scopeFindDriver($query)
    {
        $query;
    }

    public function driverLorryType()
    {
        return $this->belongsToMany(lorry::class, 'plate_number', 'driver_id', 'lorry_type_id'); //https://www.youtube.com/watch?v=cb5Xo2WY448 14:15
    }

    public function getLoris(){
    	return $this->hasMany(PlateNumber::class);
    }

    public function sites()
    {
    	return $this->hasOne(Site::class, 'id', 'sites_id');
    }

}