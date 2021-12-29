<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExtraController;
use App\Http\Controllers\Admin\FeedController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\WarehouseController;

Route::get('admin/login',
    [LoginController::class, 'login']
    )->name('admin.login');
Route::post('admin/login',
    [LoginController::class, 'authenticate']
    )->name('admin.login.authenticate');
Route::get('admin/logout',
    [LoginController::class,'logout'])
    ->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/vue/{any}', function () {
        return view('admin.admin');
      })->where('any', '.*');



    Route::get('dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');

    Route::post('chartmonth',[DashboardController::class, 'chart_month'])->name('chart_month');
    Route::post('chartyear',[DashboardController::class, 'chart_year'])->name('chart_year');

    Route::prefix('categories')->name('categories.')->group(function (){
        Route::get('/create',[CategoryController::class,'create'])->name('create');
        Route::post('/create',[CategoryController::class,'store'])->name('store');
        Route::get('',[CategoryController::class,'index'])->name('index');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[CategoryController::class,'update'])->name('edit.update');
        Route::delete('/delete', [CategoryController::class, 'destroy'])->name('delete');
        Route::get('/list',[CategoryController::class,'listCate']);
        Route::post('/add-cate',[CategoryController::class,'addCate']);
        Route::post('/edit-cate/{id}',[CategoryController::class,'editCate']);
        Route::delete('/delete-cate/{id}', [CategoryController::class, 'deleteCate']);

    });

    Route::prefix('products')->name('products.')->group(function (){
        Route::get('/create',[ProductController::class,'create'])->name('create');
        Route::post('/create',[ProductController::class,'store'])->name('store');
        Route::get('',[ProductController::class,'index'])->name('index');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[ProductController::class,'update'])->name('edit.update');
        Route::delete('delete', [ProductController::class, 'destroy'])->name('delete');
        Route::get('barcodes/{id}',[ProductController::class,'getBarcode']);
        Route::get('/export',[ProductController::class,'export'])->name('export');
        Route::get('/quotation',[ProductController::class,'quotation'])->name('quotation');
        Route::get('/list',[ProductController::class,'listProd']);
    });
    Route::prefix('banners')->name('banners.')->group(function (){
        Route::get('/create',[BannerController::class,'create'])->name('create');
        Route::post('/create',[BannerController::class,'store'])->name('store');
        Route::get('',[BannerController::class,'index'])->name('index');
        Route::get('/edit/{id}',[BannerController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[BannerController::class,'update'])->name('edit.update');
        Route::delete('/delete', [BannerController::class, 'destroy'])->name('delete');
    });
    Route::prefix('brands')->name('brands.')->group(function (){
        Route::get('/create',[BrandController::class,'create'])->name('create');
        Route::post('/create',[BrandController::class,'store'])->name('store');
        Route::get('',[BrandController::class,'index'])->name('index');
        Route::get('/edit/{id}',[BrandController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[BrandController::class,'update'])->name('edit.update');
        Route::delete('/delete', [BrandController::class, 'destroy'])->name('delete');
    });
    Route::prefix('stores')->name('stores.')->group(function (){
        Route::get('/list',[StoreController::class,'getList']);
        Route::get('/create',[StoreController::class,'create'])->name('create');
        Route::post('/create',[StoreController::class,'store'])->name('store');
        Route::get('',[StoreController::class,'index'])->name('index');
        Route::get('/edit/{id}',[StoreController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[StoreController::class,'update'])->name('edit.update');
        Route::delete('/delete', [StoreController::class, 'destroy'])->name('delete');
    });

    Route::prefix('warehouses')->name('warehouses.')->group(function (){
        Route::get('',[WarehouseController::class,'index'])->name('index');
        Route::get('/edit/{id}',[WarehouseController::class,'edit'])->name('edit');
        Route::get('/search',[WarehouseController::class,'search'])->name('search');
    });


    Route::prefix('users')->name('users.')->group(function (){
        Route::get('/edit',[UserController::class,'edit'])->name('edit');
        Route::post('/edit',[UserController::class,'update'])->name('edit.update');
        Route::get('/changepassword', [UserController::class,'index'])->name('index');
        Route::post('/changepassword',[UserController::class,'changePassword'])->name('changepassword');
        Route::get('/get-user-login',[UserController::class,'getUserLogin']);
    });

    Route::prefix('feeds')->name('feeds.')->group(function (){
        Route::get('/index',[FeedController::class,'index'])->name('index');
        Route::get('/create',[FeedController::class,'create'])->name('create');
        Route::post('/create',[FeedController::class,'store'])->name('store');

    });


    Route::prefix('extras')->name('extras.')->group(function (){
        Route::get('/create-user',[ExtraController::class,'createUser'])->middleware('role:Admin')->name('create-user');
        Route::post('/create-user',[ExtraController::class,'storeUser'])->middleware('role:Admin')->name('create-user');
        Route::get('/manage-user',[ExtraController::class,'manageUser'])->name('manage-user');
        Route::get('/edit-user/{id}',[ExtraController::class,'editUser'])->middleware('role:Admin')->name('edit-user');
        Route::post('/edit-user/{id}',[ExtraController::class,'updateUser'])->middleware('role:Admin')->name('edit-user.update');
        Route::delete('/delete-user', [ExtraController::class, 'destroy'])->middleware('role:Admin')->name('delete-user');
    });

    Route::prefix('orders')->name('orders.')->group(function (){
        Route::get('/',[OrderController::class,'order'])->name('order');
        Route::get('/index', [OrderController::class, 'indexPos']);
        Route::get('/cate', [OrderController::class, 'cate']);
        Route::get('/cart', [OrderController::class, 'getCart']);
        Route::get('add-to-cart-pos/{id}', [OrderController::class, 'addToCartPos']);
        Route::get('minus-cart/{id}', [OrderController::class, 'minusCart']);
        Route::get('remove-cart/{id}', [OrderController::class, 'removeCart']);
        Route::delete('cancel-cart', [OrderController::class, 'cancelCart']);
        Route::get('charge-cart/{id}', [OrderController::class, 'chargeCart']);
        Route::get('/select-cate/{id}', [OrderController::class, 'selectCate']);
        Route::get('/search',[OrderController::class,'search'])->name('search');
        Route::get('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('add-to-cart');
        Route::patch('update-cart', [OrderController::class, 'update'])->name('update-cart');
        Route::delete('remove-from-cart', [OrderController::class, 'remove'])->name('remove-from-cart');
        Route::get('cancel', [OrderController::class, 'cancel'])->name('cancel');
        Route::get('charge', [OrderController::class, 'charge'])->name('charge');
        Route::get('save', [OrderController::class, 'save'])->name('save');
        Route::get('print', [OrderController::class, 'print'])->name('print');
    });

    Route::post('/upload',[UploadController::class,'store'])->name('upload');

    Route::get('/cart-list',[CartController::class,'index'])->name('cart-list');
    Route::get('/cart-detail/{id}',[CartController::class,'detail'])->name('cart-detail');
    Route::delete('/cart-delete',[CartController::class,'delete'])->name('cart-delete');


    Route::prefix('purchases')->name('purchases.')->group(function (){
        Route::get('/index',[PurchaseController::class,'index'])->name('index');
        Route::get('/compelete_purchases',[PurchaseController::class,'complete_purchases'])->name('complete_purchases');
        Route::post('/uploadFile',[PurchaseController::class,'uploadFile'])->name('uploadFile');

        Route::get('/create',[PurchaseController::class,'create'])->name('create');
        Route::post('/create',[PurchaseController::class,'store'])->name('store');

        Route::delete('/delete', [PurchaseController::class, 'delete_purchase'])->name('delete_purchase');

        Route::get('/edit/{purchase_id}',[PurchaseController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[PurchaseController::class,'update_purchase'])->name('update_purchase');

        Route::get('/detail/{purchase_id}',[PurchaseController::class,'detail'])->name('detail');
        Route::get('/detail/{purchase_id}/{product_id}',[PurchaseController::class,'edit_product'])->name('edit_product');
        Route::post('/detail/{purchase_id}/{product_id}',[PurchaseController::class,'update_product'])->name('update_product');
        Route::post('/detail/add_product',[PurchaseController::class,'add_product'])->name('add_product');
        Route::post('/detail/delete_product',[PurchaseController::class,'delete_product'])->name('delete_product');

        Route::get('/payments',[PurchaseController::class,'payments'])->name('payments');
        Route::post('/payments/add_payment',[PurchaseController::class,'add_payment'])->name('add_payment');
        Route::get('/payments/{purchase_id}',[PurchaseController::class,'edit_payment'])->name('edit_payment');
        Route::post('/payments/{id}',[PurchaseController::class,'update_payment'])->name('update_payment');
        Route::delete('/payments/delete', [PurchaseController::class, 'delete_payment'])->name('delete_payment');

        Route::post('/new-purchase',[PurchaseController::class,'createPurchase']);
        Route::post('/add-product/{id}',[PurchaseController::class,'addProduct']);
        Route::get('/list',[PurchaseController::class,'getList']);
        Route::put('/purchase-payment',[PurchaseController::class,'purchasePayment']);

    });

    Route::prefix('transfers')->name('transfers.')->group(function (){
        Route::get('/list',[TransferController::class,'list'])->name('list');
        Route::get('/compelete_transfers',[TransferController::class,'complete_transfers'])->name('complete_transfers');
        Route::post('/add_transfer',[TransferController::class,'add_transfer'])->name('add_transfer');
        Route::get('/edit_transfer/{id}',[TransferController::class,'edit_transfer'])->name('edit_transfer');
        Route::post('/edit_transfer/{id}',[TransferController::class,'update_transfer'])->name('update_transfer');

        Route::get('/detail/{id}',[TransferController::class,'detail'])->name('detail');
        Route::post('/add_product',[TransferController::class,'add_product'])->name('add_product');
        Route::delete('/delete_product',[TransferController::class,'delete_product'])->name('delete_product');
        Route::delete('/delete_transfer',[TransferController::class,'delete_transfer'])->name('delete_transfer');

        Route::get('/orders_list',[TransferController::class,'orders_list'])->name('orders_list');
        Route::get('/detail_transfer_order/{id}',[TransferController::class,'detail_transfer_order'])->name('detail_transfer_order');
        Route::get('/detail_purchase_order/{id}',[TransferController::class,'detail_purchase_order'])->name('detail_purchase_order');
        Route::post('/take_order',[TransferController::class,'take_order'])->name('take_order');

        Route::post('/uploadFile',[TransferController::class,'uploadFile'])->name('uploadFile');
    });

    Route::prefix('feeds')->name('feeds.')->group(function (){
        Route::get('/upfile',[FeedController::class,'upfileView'])->name('upfileView');
        Route::post('/upFbcode',[FeedController::class,'upFbcode'])->name('upFbcode');
        Route::post('/upGgcode',[FeedController::class,'upGgcode'])->name('upGgcode');
    });

    Route::prefix('customers')->name('customers.')->group(function (){
        Route::get('/index',[CustomerController::class,'index'])->name('index');
        Route::get('/search',[CustomerController::class,'search'])->name('search');
        Route::post('/store',[CustomerController::class,'create'])->name('store');
        Route::get('/list',[CustomerController::class,'getList']);
        Route::get('/info/{id}',[CustomerController::class,'getInfo']);
        Route::get('/order-list/{id}',[CustomerController::class,'getOrderList']);
    });

    Route::prefix('suppliers')->name('suppliers.')->group(function (){
        Route::get('/list',[SupplierController::class,'getList']);

    });
    
});
