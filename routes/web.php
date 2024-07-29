<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index')->name('home');
Auth::routes(['register' => false]);
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
// PDF Views
// Route::get('/viewer/invoice/{invoice}/pdf', 'Application\PDFController@do')->name('pdf.do');
Route::get('/viewer/invoice/{invoice}/pdf', 'Application\PDFController@invoice')->name('pdf.invoice');
Route::get('/viewer/invoice/{invoice}/pdf1', 'Application\PDFController@invoice1')->name('pdf.invoice1');
Route::get('/viewer/invoice/{invoice}/pdf2', 'Application\PDFController@invoice2')->name('pdf.invoice2');
Route::get('/viewer/invoice/{invoice}/pdf3', 'Application\PDFController@do')->name('pdf.do');
Route::get('/viewer/estimate/{estimate}/pdf', 'Application\PDFController@estimate')->name('pdf.estimate');
Route::get('/viewer/payment/{payment}/pdf', 'Application\PDFController@payment')->name('pdf.payment');
Route::get('/viewer/receipts/{id}/{refrence}/pdf', 'Application\PDFController@receipts')->name('pdf.receipts');
Route::get('/viewer/receipts_transporter/{id}/pdf', 'Application\PDFController@receipts_transporter')->name('pdf.receipts_transporter');


// Customer Portal Routes
Route::group(['namespace' => 'CustomerPortal', 'prefix' => '/portal/{customer}', 'middleware' => ['customer_portal']], function () {
    // Dashboard
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index')->name('customer_portal.dashboard');

    // Invoices
    Route::get('/invoices', 'InvoiceController@index')->name('customer_portal.invoices');
    Route::get('/invoices/{invoice}', 'InvoiceController@show')->name('customer_portal.invoices.details');

    // PaypalExpress Checkout
    Route::post('/invoices/{invoice}/paypal/payment', 'Checkout\PaypalExpressController@payment')->name('customer_portal.invoices.paypal.payment');
    Route::get('/invoices/{invoice}/paypal/completed', 'Checkout\PaypalExpressController@completed')->name('customer_portal.invoices.paypal.completed');
    Route::get('/invoices/{invoice}/paypal/cancelled', 'Checkout\PaypalExpressController@cancelled')->name('customer_portal.invoices.paypal.cancelled');

    // Razorpay Checkout
    Route::get('/invoices/{invoice}/razorpay/checkout', 'Checkout\RazorpayController@checkout')->name('customer_portal.invoices.razorpay.checkout');
    Route::post('/invoices/{invoice}/razorpay/callback', 'Checkout\RazorpayController@callback')->name('customer_portal.invoices.razorpay.callback');

    // Stripe Checkout
    Route::get('/invoices/{invoice}/stripe/checkout', 'Checkout\StripeController@checkout')->name('customer_portal.invoices.stripe.checkout');
    Route::post('/invoices/{invoice}/stripe/payment', 'Checkout\StripeController@payment')->name('customer_portal.invoices.stripe.payment');
    Route::get('/invoices/{invoice}/stripe/completed', 'Checkout\StripeController@completed')->name('customer_portal.invoices.stripe.completed');

    // Estimates
    Route::get('/estimates', 'EstimateController@index')->name('customer_portal.estimates');
    Route::get('/estimates/{estimate}', 'EstimateController@show')->name('customer_portal.estimates.details');
    Route::get('/estimates/{estimate}/mark/{status?}', 'EstimateController@mark')->name('customer_portal.estimates.mark');

    // Payment
    Route::get('/payments', 'PaymentController@index')->name('customer_portal.payments');
    Route::get('/payments/{payment}', 'PaymentController@show')->name('customer_portal.payments.details');
});

// Application Routes
    Route::group(['namespace' => 'Application', 'middleware' => ['auth', 'dashboard']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard1', 'DashboardController@index')->name('salegraph');
    Route::get('/salesreport', 'DashboardController@report')->name('report');

    // Customers
    // Route::get('/customers', 'CustomerController@index')->name('customers');
    // Route::get('/customers/create', 'CustomerController@create')->name('customers.create');
    // Route::post('/customers/create', 'CustomerController@store')->name('customers.store');
    // Route::get('/customers/{customer}/details', 'CustomerController@details')->name('customers.details');
    // Route::get('/customers/{customer}/edit', 'CustomerController@edit')->name('customers.edit');
    // Route::post('/customers/{customer}/edit', 'CustomerController@update')->name('customers.update');
    // Route::get('/customers/{customer}/delete', 'CustomerController@delete')->name('customers.delete');

    // Products & Services
    Route::get('/products', 'ProductController@index')->name('products');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::post('/products/create', 'ProductController@store')->name('products.store');
    Route::get('/products/{product}/edit', 'ProductController@edit')->name('products.edit');
    Route::post('/products/{product}/edit', 'ProductController@update')->name('products.update');
    Route::get('/products/{product}/delete', 'ProductController@delete')->name('products.delete');

    // Invoices
    Route::get('/invoices/create', 'InvoiceController@create')->name('invoices.create');
    Route::get('/invoices/create/{id}', 'InvoiceController@create')->name('invoices.superadmincreate');
    Route::get('/invoices/createcash/{id}', 'InvoiceController@createcash')->name('invoices.superadmincreatecash');
    Route::get('/invoices/createcash', 'InvoiceController@createcash')->name('invoices.createcash');
    Route::post('/invoices/createcash', 'InvoiceController@store2')->name('invoices.store2');
    Route::post('/invoices/create', 'InvoiceController@store')->name('invoices.store');
    Route::get('/invoices/{invoice}/details', 'InvoiceController@show')->name('invoices.details');
    Route::get('/invoices/{invoice}/detailscash', 'InvoiceController@showcash')->name('invoices.detailscash');
    Route::get('/invoices/{invoice}/detailsdocash', 'InvoiceController@showcash')->name('invoices.detailsdocash');
    Route::get('/invoices/{invoice}/detailsdocontract', 'InvoiceController@showcash2')->name('invoices.detailsdocontract');
    Route::get('/invoices/{invoice}/detailsdocontractarrive', 'InvoiceController@showcash3')->name('invoices.detailsdoarrived');
    Route::get('/invoices/{invoice}/edit', 'InvoiceController@edit')->name('invoices.edit');
    Route::post('/invoices/{invoice}/editcash', 'InvoiceController@updatecash')->name('invoices.updatecash');
    Route::get('/invoices/{invoice}/editcash', 'InvoiceController@editcash')->name('invoices.editcash');
    Route::post('/invoices/{invoice}/edit', 'InvoiceController@update')->name('invoices.update');
    Route::get('/invoices/{invoice}/delete', 'InvoiceController@delete')->name('invoices.delete');
    Route::get('/invoices/{invoice}/send', 'InvoiceController@send')->name('invoices.send');
    Route::get('/invoices/{invoice}/mark/{status?}', 'InvoiceController@mark')->name('invoices.mark');
    Route::get('/invoices/{tab?}', 'InvoiceController@index')->name('invoices');
    Route::get('/do/{tab?}', 'InvoiceController@indexdo')->name('do');
    Route::get('/driverdepandcontract/{id}','InvoiceController@driverdepandcontract')->name('driverdepandcontract');
    Route::get('/transporlocationterdepend/{id}','InvoiceController@transporlocationterdepend')->name('transporlocationterdepend');
    Route::get('/checktransport/{id}','InvoiceController@checktransport')->name('checktransport');
    

    //Receipts
    Route::get('/receipts/{tab?}', 'ReceiptController@index')->name('receipts');
    Route::get('/receipts/contract', 'ReceiptController@index')->name('receipts.contract');
    Route::get('/create', 'ReceiptController@create')->name('receipts.create');
    Route::post('/create', 'ReceiptController@store')->name('receipts.store');
    Route::get('/receipts/{id}/{refrence}/details', 'ReceiptController@show')->name('receipts.details');
    Route::get('/filterbyclient', 'ReceiptController@filterbyclient')->name('receipts.filterbyclient');
    Route::get('/report', 'ReceiptController@report')->name('receipts.report');
    Route::get('/filterbyclient1/{id}', 'ReceiptController@filterbyclient1')->name('receipts.filterbyclient1');
    Route::get('/receipts/{invoice}/detailsreceipts', 'InvoiceController@showreceipts')->name('receipts.detailsreceipts');


    // Route::get('/receipts/{tab?}', 'InvoiceController@indexreceipt')->name('receipts');
    // Route::get('/createreceipt', 'InvoiceController@createreceipt')->name('receipts.createreceipts');
    // Route::post('/createreceipt', 'InvoiceController@storereceipt')->name('receipts.storereceipts');
    // Route::get('/filterbyclient', 'InvoiceController@filterbyclient')->name('receipts.filterbyclient');
    // Route::get('/filterbyclient1/{id}', 'InvoiceController@filterbyclient1')->name('receipts.filterbyclient1');
    // Route::get('/receipts/{invoice}/editreceipt', 'InvoiceController@editreceipt')->name('receipts.edit');
    // Route::post('/receipts/{invoice}/editreceipt', 'InvoiceController@updatereceipt')->name('receipts.update');
    // Route::get('/receipts/{invoice}/deletereceipt', 'InvoiceController@deletereceipt')->name('receipts.delete');

    //tracking
    Route::get('/tracking', 'InvoiceController@indextracking')->name('tracking');
    Route::get('/tracking/{invoice}/confirm', 'InvoiceController@accurate')->name('accurate');
    Route::get('/tracking/{invoice}/submit', 'InvoiceController@accuratesubmit')->name('accurate');
    Route::get('/tracking/{invoice}/notaccsubmit', 'InvoiceController@notaccuratesubmit')->name('notaccurate');
    Route::get('/createtracking', 'InvoiceController@createtracking')->name('tracking.createtracking');
    Route::post('/createtracking', 'InvoiceController@storetracking')->name('tracking.storetracking');
    Route::get('/tracking/{invoice}/details', 'InvoiceController@showtracking')->name('tracking.detailstracking');
    Route::get('/tracking/{invoice}/edittracking', 'InvoiceController@edittracking')->name('tracking.edit');
    Route::post('/tracking/{invoice}/edittracking', 'InvoiceController@updatetracking')->name('tracking.update');
    Route::get('/tracking/{invoice}/deletetracking', 'InvoiceController@deletetracking')->name('tracking.delete');

    //customers
    // Route::get('/customers', 'InvoiceController@indexcompleted')->name('customers');
    Route::get('/customers/{tab?}', 'CompletedController@indexcompleted')->name('customers');
    Route::get('/customers/{tracking}/tracking', 'CompletedController@tracking')->name('customers.tracking');

    // List Transactions
    // Route::get('/customers/{tracking}/info', 'InvoiceController@indextransaction')->name('customers.info');
    Route::get('/estimates/{id}/{tab?}', 'IntransitController@indextransaction')->name('estimates');
    Route::get('/transactiondetails/{id}/{tab?}', 'IntransitController@indextransaction')->name('customers.info');
    

    //Check driver/lori
    Route::get('/checkdriver/{id}','InvoiceController@checkdriver')->name('checkdriver');
    Route::get('/checklori/{id}','InvoiceController@checklori')->name('checklori');
    Route::post('/checkdriverreason','InvoiceController@checkdriverreason')->name('checkdriverreason');

    // Estimates
    Route::get('/estimates/create', 'EstimateController@create')->name('estimates.create');
    Route::post('/estimates/create', 'EstimateController@store')->name('estimates.store');
    Route::get('/estimates/{estimate}/details', 'EstimateController@show')->name('estimates.details');
    Route::get('/estimates/{estimate}/edit', 'EstimateController@edit')->name('estimates.edit');
    Route::post('/estimates/{estimate}/edit', 'EstimateController@update')->name('estimates.update');
    Route::get('/estimates/{estimate}/delete', 'EstimateController@delete')->name('estimates.delete');
    Route::get('/estimates/{estimate}/send', 'EstimateController@send')->name('estimates.send');
    Route::get('/estimates/{estimate}/mark/{status?}', 'EstimateController@mark')->name('estimates.mark');
    Route::get('/estimates/{tab?}', 'EstimateController@index')->name('estimates');

    // Payments
    Route::get('/payments', 'PaymentController@index')->name('payments');
    Route::get('/payments/create', 'PaymentController@create')->name('payments.create');
    Route::post('/payments/create', 'PaymentController@store')->name('payments.store');
    Route::get('/payments/{payment}/edit', 'PaymentController@edit')->name('payments.edit');
    Route::post('/payments/{payment}/edit', 'PaymentController@update')->name('payments.update');
    Route::get('/payments/{payment}/delete', 'PaymentController@delete')->name('payments.delete');

    // pettycash
    Route::get('/pettycash', 'PettyCashController@index')->name('pettycash');
    Route::get('/pettycash/create_debit', 'PettyCashController@createdebit')->name('pettycash.create_debit');
    Route::get('/pettycash/create_credit', 'PettyCashController@createcredit')->name('pettycash.create_credit');
    Route::post('/pettycash/create', 'PettyCashController@store_debit')->name('pettycash.store_debit');
    Route::post('/pettycash/create1', 'PettyCashController@store_credit')->name('pettycash.store_credit');
    Route::get('/pettycash/{expense}/edit', 'PettyCashController@edit')->name('pettycash.edit');
    Route::post('/pettycash/{expense}/edit', 'PettyCashController@update')->name('pettycash.update');
    Route::get('/pettycash/{expense}/receipt', 'PettyCashController@download_receipt')->name('pettycash.download_receipt');
    Route::get('/pettycash/{expense}/delete', 'PettyCashController@delete')->name('pettycash.delete');
    Route::get('/pettycash/export', 'PettyCashController@export')->name('pettycash.export');

    // Transporter
    Route::get('/transporter', 'TransporterController@index')->name('transporter');
    Route::get('/transporter/create', 'TransporterController@create')->name('transporter.create');
    Route::post('/transporter/create', 'TransporterController@store')->name('transporter.store');
    Route::get('/transporter/{transport}/details', 'TransporterController@details')->name('transporter.details');
    //Route::get('/transporter/{transport}/show', 'TransporterController@show')->name('transporter.show');
    Route::get('/transporter/{transport}/edit', 'TransporterController@edit')->name('transporter.edit');
    Route::post('/transporter/{transport}/update', 'TransporterController@update')->name('transporter.update');
    Route::get('/transporter/{transport}/delete', 'TransporterController@destroy')->name('transporter.delete');
    Route::get('/transporterselected/{id}','TransporterController@transporterselected')->name('transporterselected');
    Route::get('/transporter/{id}/{tab?}', 'TransporterController@show')->name('transporter.show');
    Route::post('/createreceipttransporter','TransporterController@createreceipttransporter')->name('createreceipttransporter');
    Route::get('/transporter/{id}/{tab?}/{transport}', 'TransporterController@detailsreceipt')->name('transporter.detailsreceipt');

    // Expenses
    Route::get('/expenses', 'ExpenseController@index')->name('expenses');
    Route::get('/expenses/create', 'ExpenseController@create')->name('expenses.create');
    Route::get('/expenses/create1', 'ExpenseController@create1')->name('expenses.create1');
    Route::post('/expenses/create', 'ExpenseController@store')->name('expenses.store');
    Route::get('/expenses/{expense}/edit', 'ExpenseController@edit')->name('expenses.edit');
    Route::post('/expenses/{expense}/edit', 'ExpenseController@update')->name('expenses.update');
    Route::get('/expenses/{expense}/receipt', 'ExpenseController@download_receipt')->name('expenses.download_receipt');
    Route::get('/expenses/{expense}/delete', 'ExpenseController@delete')->name('expenses.delete');

    // Vendors
    Route::get('/vendors', 'VendorController@index')->name('vendors');
    Route::get('/vendors/create', 'VendorController@create')->name('vendors.create');
    Route::post('/vendors/create', 'VendorController@store')->name('vendors.store');
    Route::get('/vendors/{vendor}/details', 'VendorController@details')->name('vendors.details');
    Route::get('/vendors/{vendor}/edit', 'VendorController@edit')->name('vendors.edit');
    Route::post('/vendors/{vendor}/edit', 'VendorController@update')->name('vendors.update');
    Route::get('/vendors/{vendor}/delete', 'VendorController@delete')->name('vendors.delete');

    // Client
    Route::get('/client', 'ClientController@index')->name('client');
    Route::get('/client/create', 'ClientController@create')->name('client.create');
    Route::post('/client/store', 'ClientController@store')->name('client.store');
    Route::get('/client/{client}/details', 'ClientController@details')->name('client.details');
    Route::get('/client/{client}/edit', 'ClientController@edit')->name('client.edit');
    Route::post('/client/{client}/edit', 'ClientController@update')->name('client.update');
    Route::get('/client/{client}/delete', 'ClientController@delete')->name('client.delete');

    // Driver
    Route::get('/driver', 'DriverController@index')->name('driver');
    Route::get('/driver/create', 'DriverController@create')->name('driver.create');
    Route::post('/driver/store', 'DriverController@store')->name('driver.store');
    Route::get('/driver/{driver}/details', 'DriverController@details')->name('driver.details');
    Route::get('/driver/{driver}/edit', 'DriverController@edit')->name('driver.edit');
    Route::post('/driver/{driver}/edit', 'DriverController@update')->name('driver.update');
    Route::get('/driver/{driver}/delete', 'DriverController@delete')->name('driver.delete');
    Route::get('/driver/{driver}/tracking', 'DriverController@tracking')->name('driver.tracking');

    // Inventory Routes

    //Inventory Setting > Inventory
    Route::resource('inventory/settings', 'Inventory\InventorySettingController');

    //Inventory Setting > Supplier
    Route::get('/inventory/supplier/{id}/delete', 'Inventory\SupplierController@destroy')->name('supplier.delete');
    Route::resource('inventory/supplier', 'Inventory\SupplierController')->except([
        'destroy'
    ]);

    //Inventory Setting > Products
    Route::get('inventory/productInventory/{id}/delete', 'Inventory\ProductInventoryController@destroy')->name('productInventory.delete');
    Route::resource('inventory/productInventory', 'Inventory\ProductInventoryController')->except([
        'destroy'
    ]);

    //Inventory Managment > Stock
    Route::get('/inventory/managements/export', 'Inventory\InventoryManagementController@export')->name('managements.export');
    Route::get('/inventory/managements/stockout', 'Inventory\InventoryManagementController@stockout')->name('managements.stockout');
    Route::post('/inventory/managements/stockout', 'Inventory\InventoryManagementController@stockout_store')->name('managements.stockout_store');
    Route::get('/getProductBySupplierID/{id}', 'Inventory\InventoryManagementController@getProductBySupplierID')->name('managements.getProductBySupplierID');
    Route::resource('inventory/managements', 'Inventory\InventoryManagementController');


    // Setting Routes
    Route::group(['namespace' => 'Settings', 'prefix' => 'settings'], function () {
        // Settings>Account Settings
        Route::get('/account', 'AccountController@index')->name('settings.account');
        Route::post('/account', 'AccountController@update')->name('settings.account.update');

        // Settings>Notification Settings
        Route::get('/notifications', 'NotificationController@index')->name('settings.notifications');
        Route::post('/notifications', 'NotificationController@update')->name('settings.notifications.update');

        // Settings>Company Settings
        Route::get('/company', 'CompanyController@index')->name('settings.company');
        Route::get('/list', 'CompanyController@list')->name('settings.company.list');
        Route::get('/create', 'CompanyController@create')->name('settings.company.create');
        Route::post('/create', 'CompanyController@store')->name('settings.company.store');
        //Route::post('/company', 'CompanyController@update')->name('settings.company.update');
        Route::get('/company/{id}/edit', 'CompanyController@edit')->name('settings.company.edit');
        Route::post('/company/{id}/edit', 'CompanyController@update')->name('settings.company.update');
        Route::get('/company/{id}/delete', 'CompanyController@destroy')->name('settings.company.delete');

        // Settings>Preferences
        Route::get('/preferences', 'PreferenceController@index')->name('settings.preferences');
        Route::post('/preferences', 'PreferenceController@update')->name('settings.preferences.update');

        // Route::get('/preferences', 'PreferenceController@index')->name('settings.preferences');
        // Route::get('/preferences/create', 'PreferenceController@create')->name('settings.preferences.create');
        // Route::post('/preferences/create', 'PreferenceController@store')->name('settings.preferences.store');
        // Route::get('/preferences/{id}/edit', 'PreferenceController@edit')->name('settings.preferences.edit');
        // Route::post('/preferences/{id}/edit', 'PreferenceController@update')->name('settings.preferences.update');

        // Settings>Invoice Settings
        Route::get('/invoice', 'InvoiceController@index')->name('settings.invoice');
        Route::post('/invoice', 'InvoiceController@update')->name('settings.invoice.update');

        // Settings>Estimate Settings
        Route::get('/estimate', 'EstimateController@index')->name('settings.estimate');
        Route::post('/estimate', 'EstimateController@update')->name('settings.estimate.update');

        // Settings>Payment Settings
        Route::get('/payment', 'PaymentController@index')->name('settings.payment');
        Route::post('/payment', 'PaymentController@update')->name('settings.payment.update');
        Route::get('/payment/type/create', 'PaymentTypeController@create')->name('settings.payment.type.create');
        Route::post('/payment/type/create', 'PaymentTypeController@store')->name('settings.payment.type.store');
        Route::get('/payment/type/{type}/edit', 'PaymentTypeController@edit')->name('settings.payment.type.edit');
        Route::post('/payment/type/{type}/edit', 'PaymentTypeController@update')->name('settings.payment.type.update');
        Route::get('/payment/type/{type}/delete', 'PaymentTypeController@delete')->name('settings.payment.type.delete');
        Route::get('/payment/gateway/{gateway}/edit', 'PaymentGatewayController@edit')->name('settings.payment.gateway.edit');
        Route::post('/payment/gateway/{gateway}/edit', 'PaymentGatewayController@update')->name('settings.payment.gateway.update');

        // Settings>Product Settings
        Route::get('/product', 'ProductController@index')->name('settings.product');
        Route::post('/product', 'ProductController@update')->name('settings.product.update');
        Route::get('/product/unit/create', 'ProductUnitController@create')->name('settings.product.unit.create');
        Route::post('/product/unit/create', 'ProductUnitController@store')->name('settings.product.unit.store');
        Route::get('/product/unit/{product_unit}/edit', 'ProductUnitController@edit')->name('settings.product.unit.edit');
        Route::post('/product/unit/{product_unit}/edit', 'ProductUnitController@update')->name('settings.product.unit.update');
        Route::get('/product/unit/{product_unit}/delete', 'ProductUnitController@delete')->name('settings.product.unit.delete');

        // Settings>Tax Types
        Route::get('/tax-types', 'TaxTypeController@index')->name('settings.tax_types');
        Route::get('/tax-types/create', 'TaxTypeController@create')->name('settings.tax_types.create');
        Route::post('/tax-types/create', 'TaxTypeController@store')->name('settings.tax_types.store');
        Route::get('/tax-types/{tax_type}/edit', 'TaxTypeController@edit')->name('settings.tax_types.edit');
        Route::post('/tax-types/{tax_type}/edit', 'TaxTypeController@update')->name('settings.tax_types.update');
        Route::get('/tax-types/{tax_type}/delete', 'TaxTypeController@delete')->name('settings.tax_types.delete');

        // Settings>Expense Categories
        Route::get('/expense-categories', 'ExpenseCategoryController@index')->name('settings.expense_categories');
        Route::get('/expense-categories/create', 'ExpenseCategoryController@create')->name('settings.expense_categories.create');
        Route::post('/expense-categories/create', 'ExpenseCategoryController@store')->name('settings.expense_categories.store');
        Route::get('/expense-categories/{expense_category}/edit', 'ExpenseCategoryController@edit')->name('settings.expense_categories.edit');
        Route::post('/expense-categories/{expense_category}/edit', 'ExpenseCategoryController@update')->name('settings.expense_categories.update');
        Route::get('/expense-categories/{expense_category}/delete', 'ExpenseCategoryController@delete')->name('settings.expense_categories.delete');

        // Settings>Team
        Route::get('/team', 'TeamController@index')->name('settings.team');
        Route::get('/team/add-member', 'TeamController@createMember')->name('settings.team.createMember');
        Route::post('/team/add-member', 'TeamController@storeMember')->name('settings.team.storeMember');
        Route::get('/team/{member}/edit', 'TeamController@editMember')->name('settings.team.editMember');
        Route::post('/team/{member}/edit', 'TeamController@updateMember')->name('settings.team.updateMember');
        Route::get('/team/{member}/delete', 'TeamController@deleteMember')->name('settings.team.deleteMember');

        // Settings>sites
        Route::get('/site', 'SiteController@index')->name('settings.site');
        Route::get('/site/add-site', 'SiteController@create')->name('settings.site.create');
        Route::post('/site/add-site', 'SiteController@store')->name('settings.site.store');
        Route::get('/site/{id}/edit', 'SiteController@edit')->name('settings.site.edit');
        Route::post('/site/{id}/edit', 'SiteController@update')->name('settings.site.update');
        Route::get('/site/{id}/delete', 'SiteController@destroy')->name('settings.site.delete');

        // Settings>role
        Route::get('/roles', 'RoleController@index')->name('settings.role');
        Route::get('/roles/add-role', 'RoleController@create')->name('settings.role.create');
        Route::post('/roles/add-role', 'RoleController@store')->name('settings.role.store');
        Route::get('/roles/{id}/edit', 'RoleController@edit')->name('settings.role.edit');
        Route::post('/roles/{id}/edit', 'RoleController@update')->name('settings.role.update');
        Route::get('/roles/{id}/delete', 'RoleController@destroy')->name('settings.role.delete');

        // Settings>Email Templates
        Route::get('/email-templates', 'EmailTemplateController@index')->name('settings.email_template');
        Route::post('/email-templates', 'EmailTemplateController@update')->name('settings.email_template.update');

    });

    // Ajax requests
    Route::get('/ajax/products/{id}', 'AjaxController@products')->name('ajax.products');
    Route::get('/ajax/products1/{id}', 'AjaxController@products1')->name('ajax.products1');
    Route::get('/ajax/products2', 'AjaxController@products2')->name('ajax.products2');
    Route::get('/ajax/customers', 'AjaxController@customers')->name('ajax.customers');
    Route::get('/ajax/clients', 'AjaxController@clients')->name('ajax.clients');
    Route::get('/ajax/invoices', 'AjaxController@invoices')->name('ajax.invoices');
});
