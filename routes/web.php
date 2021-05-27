<?php

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

Route::group(['middleware' => 'web'], function () {
    Auth::routes();

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'Dashboard@index');
        Route::get('/dashboard', 'Dashboard@index')->name('dashboard');
//        Route::get('/home', 'Dashboard@index')->name('home');

        /////////////////////////Start Mundi purchase////////////////////
        ///
        Route::get('/CreatePurchase','MandiPurchaseController@create')->name('purchase_item');
        Route::post('/mandi_purchase_store','MandiPurchaseController@store')->name('mandi.store');
        Route::get('/CustomerList','MandiPurchaseController@list')->name('CustomerList');
        Route::any('/mandipurchaseinvoice/{id}','MandiPurchaseController@purchaseinvoice');
        Route::get('/mandipurchaseorder', 'MandiPurchaseController@mandipurchaseorder')->name('mandipurchaseorder');


        Route::get('/CreateSale','MandiSaleControllr@create')->name('createsale');
        Route::post('/MandiSaleStore','MandiSaleControllr@store');
        Route::get('/SaleList','MandiSaleControllr@list')->name('SaleList');
        Route::any('/MandiSaleInvoice/{id}','MandiSaleControllr@saleinvoice');
        Route::get('/mandisaleorder', 'MandiSaleControllr@mandisaleorder')->name('mandisaleorder');

        Route::get('/mandi_customer','MandiCustomer@index')->name('mandi_customer');
        Route::post('/customer_store','MandiCustomer@store')->name('mandi_customer.store');


        Route::get('/create','ItemController@create')->name('create_item');
        Route::post('/item_store','ItemController@store')->name('store_item');
        Route::post('/checkitem','ItemController@checkItem');


        /////////////////////////End Mundi purchase////////////////////





        Route::post('/vendorupdate/{id}','VendorController@vendorupdate');
        Route::get('/vendoredit/{id}','VendorController@vendoredit');
        Route::any('/vendordel/{id}','VendorController@vendordelete');

        Route::resource('/customer', 'CustomerController');
        Route::post('/customerupdate/{id}','CustomerController@customerupdate');
        Route::get('/customeredit/{customer}', 'CustomerController@customeredit');
        Route::any('/customerdel/{id}','CustomerController@customerdelete');

        Route::resource('/product', 'ProductController');
        Route::post('/productupdate/{id}','ProductController@productupdate');
        Route::get('/productedit/{id}','ProductController@productedit');
        Route::any('/productdel/{id}','ProductController@productdelete');

        Route::resource('/purchase', 'PurchaseController');
        Route::post('/purchaseupdate/{id}','PurchaseController@purchaseupdate');
        Route::get('/purchaseedit/{id}','PurchaseController@purchaseedit')->name('purchaseeditlist');
        Route::any('/purchasedel/{id}','PurchaseController@purchasedelete');
        Route::any('/purchasepayupdate/{id}','PurchaseController@purchasepayupdate');
        Route::any('/purchaseinvoice/{id}','PurchaseController@purchaseinvoice');

        Route::resource('/sale', 'SaleController');
        Route::any('/saleupdate/{id}','SaleController@saleupdate');
        Route::get('/saleedit/{id}','SaleController@saleedit');
        Route::any('/saledel/{id}','SaleController@saledelete');
        Route::any('/salepayupdate/{id}','SaleController@salepayupdate');
        Route::any('/saleinvoice/{id}','SaleController@saleinvoice')->name('saleinvoice');


        Route::resource('/saledetail', 'SaleDetailController');
        Route::post('/saledetailupdate/{id}','SaleDetailController@saledetailupdate');
        Route::get('/saledetailedit/{id}','SaleDetailController@saledetailedit');
        Route::any('/saledetaildel/{id}','SaleDetailController@saledetaildelete');

        Route::resource('/purchasedetail', 'PurchaseDetailController');
        Route::post('/purchasedetailupdate/{id}','PurchasedetailController@purchasedetailupdate');
        Route::get('/purchasedetailedit/{id}','PurchasedetailController@purchasedetailedit');
        Route::any('/purchasedetaildel/{id}','PurchasedetailController@purchasedetaildelete');
        //master pages
        Route::resource('/region', 'RegionController');
        Route::post('/regionupdate/{id}','RegionController@regionupdate');
        Route::get('/regionedit/{id}','RegionController@regionedit');
        Route::any('/regiondel/{id}','RegionController@regiondelete');
        Route::resource('/category', 'CategoryController');
        Route::post('/categoryupdate/{id}','CategoryController@categoryupdate');
        Route::get('/categoryedit/{id}','CategoryController@categoryedit');
        Route::any('/categorydel/{id}','CategoryController@categorydelete');

        // Inventory View Start From Here 7/7/2020
        Route::get('/inventory','ReportController@inventory_report');

        Route::get('/ledger','ReportController@ledger')->name('ledger');

        // Sale Report view Start From Here 7/7/2020
        Route::get('sale-report',function()
        {
            return View::make('Sale_Report.Sale_Report');
        });
        Route::get('/saleorderreport','ReportController@saleorderreport')->name('saleorderreport');
        //For Accounts Crud 7/9/2020
        Route::resource('/accountManagement' , 'AccountManagementController');
        //For Update the Account
        Route::post('/accountupdate/{id}','AccountManagementController@accountupdate');
        Route::get('/trilebalence','AccountManagementController@viewtrileblns')->name('trilebalence');
        //For Edit the Account
        Route::get('/accountedit/{id}', 'AccountManagementController@accountedit');
        Route::any('/accountdelete/{id}', 'AccountManagementController@accountdelete');
        Route::resource('/accountType', 'AccountTypeController');
        Route::any('/accountypeupdate/{id}', 'AccountTypeController@accountupdate');
        Route::any('/accounttypedelete/{id}', 'AccountTypeController@accounttypedelete');

        // reports
        Route::get('/purchaseorder', 'ReportController@purchaseorder')->name('purchaseorder');
        Route::post('/purchaseordersum', 'ReportController@purchaseOrderSummary');
        Route::any('/inventry', 'ReportController@inventry')->name('inventry');
        Route::get('/sale_report', 'ReportController@sale_report')->name('sale_report');
        Route::get('/lowStock', 'ReportController@lowStock')->name('lowstock');
        Route::get('/balance_sheet', 'ReportController@balance_sheet')->name('balance_sheet');
        Route::get('/trialbalance', 'ReportController@trialbalance')->name('trialbalance');
        Route::get('/profitloss', 'ReportController@profitloss')->name('profitloss');

        //==============Journal=============== 17/7/2020
        Route::resource('/journal', 'JournalController');
        Route::any('J_Edit/{id}', 'JournalController@journal_Edit')->name('journal_Edit');
        Route::any('J_delete/{id}', 'JournalController@delete')->name('J_delete');
        Route::post('journal_update/{id}', 'JournalController@journal_update');
        Route::get('export', 'JournalController@export')->name('export');


        /////////////////////////city///////////////////////////////
        Route::get('/city', 'CityController@index')->name('city_view');
        Route::post('/cityCreate/', 'CityController@create')->name('city_store');
        Route::post('/ajax_citycreate/', 'CityController@citycreate');
        Route::post('/cityupdate/{id}','CityController@cityupdate');
        Route::get('/cityedit/{id}','CityController@cityedit');
        Route::any('/citydel/{id}','CityController@citydelete');
        Route::get('/cityRegion/{region}', 'CityController@cityRegion')->name('cityRegion');

        //Route for transection history
        Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('admin');

        Route::resource('/vendor', 'VendorController');

        Route::group(['middleware' => 'admin'], function () {
            Route::resource('/adminlist','UserController');
            Route::post('/adminupdate/{id}','UserController@adminupdate');

            Route::get('/operatorlist','UserController@operatorlist')->name('operatorlist');
            Route::any('/admindel/{id}','UserController@destroy')->name('admindel');
            Route::any('/operaterdel/{id}','UserController@operaterdel')->name('operaterdel');
            Route::any('/adminedit/{id}','UserController@adminedit')->name('adminedit');
            Route::any('/operateredit/{id}','UserController@operateredit')->name('operateredit');
            Route::resource('/transection', 'TransectionHistoryController');
            // Settings Start from Here
            Route::resource('/setting','SettingController');
        });
    });
});
