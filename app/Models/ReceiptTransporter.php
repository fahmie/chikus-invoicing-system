<?php

namespace App\Models;

use App\Traits\HasTax;
use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Model;

class ReceiptTransporter extends Model
{
    use HasTax;
    use UUIDTrait;

    protected $table = 'receipt_transporters';

    protected $fillable = [
        'id', 'uid', 'invoice_id', 'receipt_number_transporter', 'reference_number','reference_number_transporter','payment_type', 'payment_status', 'quantity_start',
        'quantity_arrived', 'quantity_shortage', 'amount_start', 'amount_arrived', 'amount_shortage', 'net_pay_amount',

    ];
    public function invoices()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_type', 'id');
    }

    public function paymentstatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status');
    }

    public function items()
    {
        return $this->belongsTo(InvoiceItem::class, 'invoice_id', 'invoice_id');
    }
}
