<?php


//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'PostController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@getIndex']);
Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', ['as' => 'login', 'uses' => 'HomeController@getLoginPage']);
    Route::post('/login', ['as' => 'attempt_login', 'uses' => 'HomeController@attemptLogin']);
});


Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', ['as' => 'logout', 'uses' => 'HomeController@logout']);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@getDashboard']);
    Route::group(['prefix' => 'unit', 'middleware' => 'mainUnit'], function() {
        //Unit
        Route::get('/list-unit', ['as' => 'list_unit', 'uses' => 'UnitController@listUnit']);
        Route::get('/add-unit', ['as' => 'add_unit', 'uses' => 'UnitController@addUnit']);
        Route::post('/save-unit', ['as' => 'save_unit', 'uses' => 'UnitController@saveUnit']);
        Route::get('/view-unit/{id}', ['as' => 'view_unit', 'uses' => 'UnitController@viewUnit']);
        Route::get('/edit-unit/{id}', ['as' => 'edit_unit', 'uses' => 'UnitController@editUnit']);
        Route::post('/update-unit/{id}', ['as' => 'update_unit', 'uses' => 'UnitController@updateUnit']);
        Route::get('/unpublish-unit/{id}', ['as' => 'unpublish_unit', 'uses' => 'UnitController@unpublishUnit']);
        Route::get('/publish-unit/{id}', ['as' => 'publish_unit', 'uses' => 'UnitController@publishUnit']);
        Route::get('/delete-unit/{id}', ['as' => 'delete_unit', 'uses' => 'UnitController@deleteUnit']);
    });
    //Employee
    Route::group(['prefix' => 'employee'], function() {
        //Employee
        Route::get('/list-employee', ['as' => 'list_employee', 'uses' => 'EmployeeController@listEmployee']);
        Route::get('/add-employee', ['as' => 'add_employee', 'uses' => 'EmployeeController@addEmployee']);
        Route::post('/save-employee', ['as' => 'save_employee', 'uses' => 'EmployeeController@saveEmployee']);
        Route::get('/view-employee/{id}', ['as' => 'view_employee', 'uses' => 'EmployeeController@viewEmployee']);
        Route::get('/edit-employee/{id}', ['as' => 'edit_employee', 'uses' => 'EmployeeController@editEmployee']);
        Route::post('/update-employee/{id}', ['as' => 'update_employee', 'uses' => 'EmployeeController@updateEmployee']);
        Route::get('/unpublish-employee/{id}', ['as' => 'unpublish_employee', 'uses' => 'EmployeeController@unpublishEmployee']);
        Route::get('/publish-employee/{id}', ['as' => 'publish_employee', 'uses' => 'EmployeeController@publishEmployee']);
        Route::get('/delete-employee/{id}', ['as' => 'delete_employee', 'uses' => 'EmployeeController@deleteEmployee']);
    });
    //Stock
    Route::group(['prefix' => 'stock'], function() {
        Route::get('/list-stock', ['as' => 'list_stock', 'uses' => 'StockController@listStock']);
        Route::get('/list-stock-sub', ['as' => 'list_stock_sub', 'uses' => 'StockController@listStockSub']);
        Route::get('/add-stock', ['as' => 'add_stock', 'uses' => 'StockController@addStock']);
        Route::post('/save-stock', ['as' => 'save_stock', 'uses' => 'StockController@saveStock']);
        Route::get('/edit-stock/{id}', ['as' => 'edit_stock', 'uses' => 'StockController@editStock']);
        Route::post('/update-stock/{id}', ['as' => 'update_stock', 'uses' => 'StockController@updateStock']);
        Route::get('/unpublish-stock/{id}', ['as' => 'unpublish_stock', 'uses' => 'StockController@unpublishStock']);
        Route::get('/publish-stock/{id}', ['as' => 'publish_stock', 'uses' => 'StockController@publishStock']);
        Route::get('/delete-stock/{id}', ['as' => 'delete_stock', 'uses' => 'StockController@deleteStock']);
    });

    Route::group(['prefix' => 'items'], function(){
        //Product
        Route::group(['prefix' => 'product'], function() {
            Route::get('/list-product', ['as' => 'list_product', 'uses' => 'ProductController@listProduct']);
            Route::get('/add-product', ['as' => 'add_product', 'uses' => 'ProductController@addProduct']);
            Route::post('/save-product', ['as' => 'save_product', 'uses' => 'ProductController@saveProduct']);
            Route::get('/edit-product/{id}', ['as' => 'edit_product', 'uses' => 'ProductController@editProduct']);
            Route::get('/view-product/{id}', ['as' => 'view_product', 'uses' => 'ProductController@viewProduct']);
            Route::post('/update-product/{id}', ['as' => 'update_product', 'uses' => 'ProductController@updateProduct']);
            Route::get('/unpublish-product/{id}', ['as' => 'unpublish_product', 'uses' => 'ProductController@unpublishProduct']);
            Route::get('/publish-product/{id}', ['as' => 'publish_product', 'uses' => 'ProductController@publishProduct']);
            Route::get('/delete-product/{id}', ['as' => 'delete_product', 'uses' => 'ProductController@deleteProduct']);
            Route::get('/get-product-by-id/{id}', ['as' => 'get_product_by_id', 'uses' => 'ProductController@getProductById']);
        });
        
        //Product Category
        Route::group(['prefix' => 'category'], function() {
            Route::get('/list-product-category', ['as' => 'list_product_category', 'uses' => 'ProductCategoryController@listProductCategory']);
            Route::get('/add-product-category', ['as' => 'add_product_category', 'uses' => 'ProductCategoryController@addProductCategory']);
            Route::post('/save-product-category', ['as' => 'save_product_category', 'uses' => 'ProductCategoryController@saveProductCategory']);
            Route::get('/edit-product-category/{id}', ['as' => 'edit_product_category', 'uses' => 'ProductCategoryController@editProductCategory']);
            Route::post('/update-product-category/{id}', ['as' => 'update_product_category', 'uses' => 'ProductCategoryController@updateProductCategory']);
            Route::get('/unpublish-product-category/{id}', ['as' => 'unpublish_product_category', 'uses' => 'ProductCategoryController@unpublishProductCategory']);
            Route::get('/publish-product-category/{id}', ['as' => 'publish_product_category', 'uses' => 'ProductCategoryController@publishProductCategory']);
            Route::get('/delete-product-category/{id}', ['as' => 'delete_product_category', 'uses' => 'ProductCategoryController@deleteProductCategory']);
            Route::get('/get-product-category-by-id/{id}', ['as' => 'get_product_category_by_id', 'uses' => 'ProductCategoryController@getProductCategoryById']);
        });
        //Product Brand
        Route::group(['prefix' => 'brand'], function() {
            Route::get('/list-product-brand', ['as' => 'list_product_brand', 'uses' => 'ProductBrandController@listProductBrand']);
            Route::get('/add-product-brand', ['as' => 'add_product_brand', 'uses' => 'ProductBrandController@addProductBrand']);
            Route::post('/save-product-brand', ['as' => 'save_product_brand', 'uses' => 'ProductBrandController@saveProductBrand']);
            Route::get('/edit-product-brand/{id}', ['as' => 'edit_product_brand', 'uses' => 'ProductBrandController@editProductBrand']);
            Route::post('/update-product-brand/{id}', ['as' => 'update_product_brand', 'uses' => 'ProductBrandController@updateProductBrand']);
            Route::get('/unpublish-product-brand/{id}', ['as' => 'unpublish_product_brand', 'uses' => 'ProductBrandController@unpublishProductBrand']);
            Route::get('/publish-product-brand/{id}', ['as' => 'publish_product_brand', 'uses' => 'ProductBrandController@publishProductBrand']);
            Route::get('/delete-product-brand/{id}', ['as' => 'delete_product_brand', 'uses' => 'ProductBrandController@deleteProductBrand']);
            Route::get('/get-product-brand-by-id/{id}', ['as' => 'get_product_brand_by_id', 'uses' => 'ProductBrandController@getProductBrandById']);
        });
    });

    //Demand
    Route::group(['prefix' => 'demand'], function() {
        Route::get('/demand-request-sub', ['as' => 'demand_request_sub', 'uses' => 'DemandController@demandRequestSub'])->middleware('subUnit');
        Route::get('/demand-request-main', ['as' => 'demand_request_main', 'uses' => 'DemandController@demandRequestMain'])->middleware('mainUnit');
        Route::post('/save-pre-demand', ['as' => 'save_pre_demand', 'uses' => 'DemandController@savePreDemand']);
        Route::get('/remove-pre-demand-item/{id}', ['as' => 'remove_pre_demand_item', 'uses' => 'DemandController@removePreDemandItem']);
        Route::get('/remove-pre-demand', ['as' => 'remove_pre_demand', 'uses' => 'DemandController@removePreDemand']);
        Route::get('/save-demand', ['as' => 'save_demand', 'uses' => 'DemandController@saveDemand']);
        Route::get('/view-demand/{demand_no}', ['as' => 'view_demand', 'uses' => 'DemandController@viewDemand']);
        Route::get('/demand-approval/{demand_no}', ['as' => 'demand_approval', 'uses' => 'DemandController@demandApproval']);
        Route::post('/save-demand-approval/{demand_id}', ['as' => 'save_demand_approval', 'uses' => 'DemandController@saveDemandApproval']);
    });
    
    //Distribution
    Route::group(['prefix' => 'distribution', 'middleware' => 'mainUnit'], function(){
        Route::get('/list-distribution-main', ['as' => 'list_distribution_main', 'uses' => 'DistributionController@listDistributionMain']);
        Route::get('/distribution-main/{demand_no}', ['as' => 'distribution_main', 'uses' => 'DistributionController@distributionMain']);
        Route::post('/save-distribution-main/{demand_id}', ['as' => 'save_distribution_main', 'uses' => 'DistributionController@saveDistributionMain']);
    });
    Route::group(['prefix' => 'distribution', 'middleware' => 'subUnit'], function(){
        Route::get('/distribution-sub', ['as' => 'distribution_sub', 'uses' => 'DistributionController@distributionSub']);
        Route::post('/save-distribution-sub', ['as' => 'save_distribution_sub', 'uses' => 'DistributionController@saveDistributionSub']);
    });
    
    //Report
    Route::group(['prefix' => 'report'], function(){
        Route::get('/demand-report', ['as' => 'demand_report', 'uses' => 'ReportController@onDemandReport']);
        Route::get('/stock-report', ['as' => 'stock_report', 'uses' => 'ReportController@onStockReport']);
        Route::get('/distribution-report', ['as' => 'distribution_report', 'uses' => 'ReportController@onDistributionReport']);
    });
});

