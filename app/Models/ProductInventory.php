<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUIDTrait;


class ProductInventory extends Model
{
    use SoftDeletes;
    use UUIDTrait;

    protected $fillable = [
        'id', 'uid', 'unit_id', 'name', 'description', 'sites_id',
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
     * List product for Select2 Javascript Library
     * 
     * @return json
     */ 
    public static function getSelect2Array($sites_id) {
        // return
        return self::findBySites($sites_id)
            ->select('id', 'name AS text')
            ->get();
    }

    public function unit()
    {
        return $this->belongsTo(ProductUnit::class);
    }
}
