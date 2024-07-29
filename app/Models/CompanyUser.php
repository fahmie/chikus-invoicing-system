<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    protected $table = 'company_user';

    protected $fillable = [
        'user_id', 'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
