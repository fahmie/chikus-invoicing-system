<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{
    protected $fillable = [
        'id','sites_id', 'detail', 'debit', 'credit', 'balance', 'remark','date', 'time','filename',
    ];

    public function sites()
    {
    	return $this->hasOne(Site::class, 'id', 'sites_id');
    }

}
