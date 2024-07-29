<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransporterDetailView extends Model
{
    protected $table = 'transporter_detail_view';

    protected $fillable = [
        'id', 'driver_id', 'transporter_id', 'location_id', 'plate_number', 'invoice_number', 'do_number', 
        'receipt_number', 'status', 'paid_status', 'total', 'blance', 'discount', 'total_quantity', 'total_price',
        'total_inaccurate','price_transporter'
    ];


    public function drivers(){
    	return $this->belongsTo(Driver::class, 'driver_id','id');
    }

    public function clients(){
    	return $this->belongsTo(Client::class, 'client_id','id');
    }

    public function transporters(){
    	return $this->belongsTo(Transporter::class, 'transporter_id','id');
    }

    public function trackings(){
    	return $this->belongsTo(Trackinginfo::class, 'invoice_id','id');
    }

    public function receipttransporters(){
    	return $this->belongsTo(ReceiptTransporter::class, 'invoice_id','id');
    }

    public function platenumbers(){
    	return $this->hasOne(PlateNumber::class, 'id', 'plate_number_id');
    }
}
