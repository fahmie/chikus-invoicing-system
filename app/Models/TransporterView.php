<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransporterView extends Model
{
    protected $table = 'transporter_view';

    protected $fillable = [
        'id', 'uid', 'type', 'client_id', 'driver_id', 'customer_id', 'company_id', 'transporter_id', 'location_id',
        'plate_number', 'invoice_date', 'due_date', 'invoice_number', 'do_number', 'receipt_number', 'reference_number',
        'status', 'paid_status', 'payment_status_id', 'tax_per_item', 'discount_per_item', 'notes', 'private_notes', 
        'discount_type', 'discount_val', 'sub_total', 'total', 'blance', 'discount', 'due_amount', 'accurate', 
        'accurate_remark', 'sent', 'viewed', 'created_at', 'updated_at', 'price', 'quantity', 'total_rm_inaccurate'
    ];


    public function drivers(){
    	return $this->belongsTo(Driver::class, 'driver_id','id' );
    }

    public function clients(){
    	return $this->belongsTo(Client::class, 'client_id','id' );
    }

    public function trackings(){
    	return $this->belongsTo(Trackinginfo::class, 'invoice_id','id' );
    }

    public function platenumbers(){
    	return $this->hasOne(PlateNumber::class, 'id', 'plate_number');
    }
}
