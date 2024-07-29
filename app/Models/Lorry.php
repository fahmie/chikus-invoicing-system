<?php

namespace App\Models;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Model;

class Lorry extends Model
{
    protected $fillable = [
        'id', 'name',
    ];

    public function platenumbers()
    {
        return $this->hasOne(PlateNumber::class, 'lorry_type_id', 'id');
    }

    public function scopeFindByDriverID($query, $driver_id)
    {
        $query->where('id', $driver_id);
    }

    public function drivers(){
    	return $this->belongsToMany(Driver::class, 'lorry_type_id', 'id');
    }
}
