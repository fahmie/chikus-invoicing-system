<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-view',
            'role-create',
            'role-edit',
            'role-delete',
            'dashboard-view',
            'dashboard-export',
            'invoices-view',
            'invoices-create',
            'invoices-edit',
            'invoices-delete',
            'delivery-order-view',
            'delivery-order-create',
            'delivery-order-edit',
            'delivery-order-delete',
            'receipts-view',
            'receipts-create',
            'receipts-edit',
            'receipts-delete',
            'client-contract-view',
            'client-contract-create',
            'client-contract-edit',
            'client-contract-delete',
            'lorry-driver-view',
            'lorry-driver-create',
            'lorry-driver-edit',
            'lorry-driver-delete',
            'products-view',
            'products-create',
            'products-edit',
            'products-delete',
            'pettycash-view',
            'pettycash-create',
            'pettycash-edit',
            'pettycash-delete',
            'transporter-view',
            'transporter-create',
            'transporter-edit',
            'transporter-delete',
            'intransit-view',
            'intransit-create',
            'intransit-edit',
            'intransit-delete',
            'completed-delivery-view',
            'completed-delivery-create',
            'completed-delivery-edit',
            'completed-delivery-delete',
            'setting-account-view',
            'setting-account-create',
            'setting-account-edit',
            'setting-account-delete',
            'setting-company-view',
            'setting-company-create',
            'setting-company-edit',
            'setting-company-delete',
            'setting-sites-view',
            'setting-sites-create',
            'setting-sites-edit',
            'setting-sites-delete',
            'setting-productunit-view',
            'setting-productunit-create',
            'setting-productunit-edit',
            'setting-productunit-delete',
            'setting-product-view',
            'setting-product-create',
            'setting-product-edit',
            'setting-product-delete',
            'setting-tax-view',
            'setting-tax-create',
            'setting-tax-edit',
            'setting-tax-delete',
            'setting-team-view',
            'setting-team-create',
            'setting-team-edit',
            'setting-team-delete',
            'setting-preferences-view',
            'setting-preferences-create',
            'setting-preferences-edit',
            'setting-preferences-delete',
            'setting-invoice-view',
            'setting-invoice-create',
            'setting-invoice-edit',
            'setting-invoice-delete',
            'inventory-management-view',
            'inventory-management-addstock',
            'inventory-management-stockin',
            'inventory-management-deductstock',
            'inventory-management-stockout',
            'inventory-management-edit',
            'inventory-management-update',
            'inventory-management-delete',
            'inventory-management-export',
            'product-inventory-view',
            'product-inventory-create',
            'product-inventory-store',
            'product-inventory-edit',
            'product-inventory-update',
            'product-inventory-delete',
            'supplier-view',
            'supplier-create',
            'supplier-store',
            'supplier-edit',
            'supplier-update',
            'supplier-delete'
         ];

         foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'slug' => $permission
            ]);
       }
    }
}
