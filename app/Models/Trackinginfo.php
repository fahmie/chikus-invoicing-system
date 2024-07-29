<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trackinginfo extends Model
{

    protected $table = 'trackinginfo';

    protected $fillable = [
        'id', 'invoice_id', 'activities', 'remark', 'plate_number_id'
    ];
    
    public function invoices(){
    	return $this->hasMany(Invoice::class, 'id', 'invoice_id');
    }

    public function platenumbers(){
    	return $this->hasOne(PlateNumber::class, 'id', 'plate_number_id');
    }
}
