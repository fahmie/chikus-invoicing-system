<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransporterLocation extends Model
{
    protected $fillable = [
        'id', 'transport_id', 'name', 'price',
    ];

    public function invoices(){
    	return $this->hasMany(Invoice::class);
    }
}
