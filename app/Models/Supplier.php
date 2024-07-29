<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'id', 'name', 'address', 'email', 'phone', 'sites_id',
    ];

    public function scopeFindBySites($query, $sites_id)
    {
        $query->where('sites_id', $sites_id);
    }

    public function sites()
    {
    	return $this->hasOne(Site::class, 'id', 'sites_id');
    }

    /**
     * List sites for Select2 Javascript Library
     * 
     * @return json
     */ 
    public static function getSelect2Array($sites_id) {
        // return
        return self::findBySites($sites_id)
            ->select('id', 'name AS text')
            ->get();
    }
}
