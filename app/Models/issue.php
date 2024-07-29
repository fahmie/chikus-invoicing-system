<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class issue extends Model
{
    protected $table = 'issue';

    protected $fillable = [
        'id', 'driver_id', 'driver_name', 'invoices', 'plate_number', 'supposed_qty', 'arrived_qty', 'reason', 'datetime',
    ];
}
