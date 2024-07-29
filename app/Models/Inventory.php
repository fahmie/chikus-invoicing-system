<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    protected $fillable = [
        'id', 'sites_id', 'supplier_id', 'product_id', 'detail', 'stock_in', 'stock_out', 'stock', 'customer_name', 'customer_address', 'customer_email', 'customer_phone', 'customer_country', 'date', 'time', 'filename',
    ];

    public function scopeFindBySites($query, $sites_id)
    {
        $query->where('sites_id', $sites_id);
    }

    public function sites()
    {
    	return $this->hasOne(Site::class, 'id', 'sites_id');
    }

    public function suppliers()
    {
    	return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function products()
    {
    	return $this->hasOne(ProductInventory::class, 'id', 'product_id');
    }

    public function contary()
    {
    	return $this->hasOne(Country::class, 'id', 'customer_country');
    }
    
}
