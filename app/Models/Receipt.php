<?php

namespace App\Models;

use App\Traits\HasTax;
use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Receipt extends Model
{
    use HasTax;
    use UUIDTrait;

    // Invoice Statuses
    const STATUS_DRAFT = 'DRAFT';
    const STATUS_SENT = 'OTW';
    const STATUS_VIEWED = 'VIEWED';
    const STATUS_OVERDUE = 'OVERDUE';
    const STATUS_COMPLETED = 'COMPLETED';

    // Invoice Paid Statuses
    const STATUS_UNPAID = 'UNPAID';
    const STATUS_PARTIALLY_PAID = 'PARTIALLY_PAID';
    const STATUS_PAID = 'PAID';
    
    protected $fillable = [
        'id', 
        'uid', 
        'invoice_id', 
        'receipt_number',
        'sites_id', 
        'reference_number', 
        'total', 
        'supposed_amount',
        'balance', 
        'discount', 
        'paid_amount', 
        'last_paid_amount',
        'payment_number', 
        'payment_status', 
        'payment_method_id', 
        'payment_date'
    ];

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentstatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status');
    }

    public function invoices()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function items()
    {
        return $this->belongsTo(InvoiceItem::class, 'invoice_id', 'invoice_id');
    }

}
