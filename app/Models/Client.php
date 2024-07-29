<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','sites_id', 'company_name', 'company_no', 'address', 'transport', 'project_manager_name', 'phone', 'email', 'delivery_location', 'price',
    ];

    public function products()
    {
    	return $this->hasOne(Product::class,  'id', 'client_id');
    }

    /**
     * Scope a query to only include Invoices of a given company.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param int $client_id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeFindByClientID($query, $client_id)
    {
        $query->where('id', $client_id);
    }

    public function scopeFindClient($query)
    {
        $query;
    }
    /**
     * Scope a query to only include Invoices of a given company.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param int $company_id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function invoices(){
    	return $this->hasMany(Invoice::class, 'id', 'client_id');
    }

    public function sites()
    {
    	return $this->hasOne(Site::class, 'id', 'sites_id');
    }

    public function user()
    {
    	return $this->hasOne(User::class, 'id', 'user_id');
    }
}
