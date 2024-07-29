<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    protected $table = 'transporters';

    protected $fillable = [
        'id','sites_id', 'company_name', 'name', 'phone', 'email', 'address','remark',
    ];

    public function invoices(){
    	return $this->hasMany(Invoice::class);
    }
    
    public function sites()
    {
    	return $this->hasOne(Site::class, 'id', 'sites_id');
    }
}
