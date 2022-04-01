<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ShopCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpenceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MainSliderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubCategoryController;

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

// Route::get('/clear-cache', function() {
//     Artisan::call('cache:clear');
//     Artisan::call('config:cache');
// });

// Route::get('/link', function() {
//     Artisan::call('storage:link');
// });

// Route::get('/migrate', function() {
//     Artisan::call('migrate');
// });



Route::get('/', [FrontendController::class, 'index']);
Route::get('/single/product/{slug}', [FrontendController::class, 'singleproduct'])->name('single.product');
Route::get('/single/category/{slug}', [FrontendController::class, 'singlecategory'])->name('single.category');
Route::get('/single/subcategory/{slug}', [FrontendController::class, 'singlesubcategory'])->name('single.subcategory');
Route::get('/product/page', [FrontendController::class, 'productpage'])->name('productpage');
Route::get('/cart/page', [FrontendController::class, 'cart'])->name('cartpage');

Route::get('/signup/page', [FrontendController::class, 'signup'])->name('signuppage');
Route::get('/login/page', [FrontendController::class, 'login'])->name('loginpage');

Route::post('/customer/register', [FrontendController::class, 'customerregister'])->name('customer.register');

// Cart Route
Route::post('/add/cart/list', [CartController::class, 'addcart'])->name('cart.store');
Route::get('/remove/cart/{id}', [CartController::class, 'removecart'])->name('cartremove');
Route::post('/update/cart/list', [CartController::class, 'updatecart'])->name('cartupdate');
// Route::post('/add/cart/from/wishlist', [CartController::class, 'addcartfromwishlist'])->name('addcartfromwishlist');


//Searching Route
Route::POST('/product/searching', [FrontendController::class, 'productsearch']);




Route::get('/dashboard', [DashboardController::class, 'welcome'])->name('welcome');

Route::group(['middleware' => 'auth'], function () {

    // Dashboard Controller 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/get/filter/date', [DashboardController::class, 'filterdate']);


    // profile Routes
    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
    Route::post('/dashboard/profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');
    Route::post('/dashboard/password/update', [ProfileController::class, 'updatepassword'])->name('dashboard.password.update');

    // Pos controller 
    Route::get('/pos',[PosController::class, 'index'])->name('pos');
    Route::post('/get/unitprice',[PosController::class, 'unitprice'])->name('unitprice');
    Route::post('/get/unitprice/coad',[PosController::class, 'unitpricecoad'])->name('unitpricecoad');
    Route::post('/get/customer/phone',[PosController::class, 'customerphone'])->name('customerphone');
    Route::post('/get/customer/due',[PosController::class, 'previousdue'])->name('previousdue');

    // Admin Controller 
    Route::get('/admin/list', [AdminController::class, 'adminlist'])->name('admin.list');
    Route::post('/admin/register', [AdminController::class, 'adminregister'])->name('admin.register');
    Route::get('/admin/delete/{id}', [AdminController::class, 'admindelete'])->name('admin.delete');
    Route::get('/admin/restore/view', [AdminController::class, 'adminrestoreview'])->name('admin.restore.view');
    Route::get('/admin/restore/{id}', [AdminController::class, 'adminrestore'])->name('admin.restore');
    Route::get('/admin/forcedelete/{id}', [AdminController::class, 'forcedelete'])->name('admin.forcedelete');

    // Customer Controller 
    Route::get('/customer/list', [CustomerController::class, 'customerlist'])->name('customer.list');
    Route::get('/customer/delete/{id}', [customerController::class, 'customerdelete'])->name('customer.delete');
    Route::get('/customer/restore/view', [customerController::class, 'customerrestoreview'])->name('customer.restore.view');
    Route::get('/customer/restore/{id}', [customerController::class, 'customerrestore'])->name('customer.restore');
    Route::get('/customer/forcedelete/{id}', [customerController::class, 'forcedelete'])->name('customer.forcedelete');


    // shop category Controller 
    Route::get('/shop/category', [ShopCategoryController::class, 'index'])->name('shop.category');
    Route::post('/shop/category/add', [ShopCategoryController::class, 'store'])->name('shopcategory.store');
    Route::post('/shop/category/edit', [ShopCategoryController::class, 'shopcategoryedit'])->name('shopcategory.edit');
    Route::get('/shop/category/delete/{id}', [ShopCategoryController::class, 'shopcategorydelete'])->name('shopcategory.delete');
    Route::get('/shop/category/restore/view', [ShopCategoryController::class, 'shopcategoryrestoreview'])->name('shopcategory.restore.view');
    Route::get('/shop/category/restore/{id}', [ShopCategoryController::class, 'shopcategoryrestore'])->name('shopcategory.restore');
    Route::get('/shop/category/forcedelete/{id}', [ShopCategoryController::class, 'forcedelete'])->name('shopcategory.forcedelete');

    // SubCategory Controller 
    Route::resource('subcategory', SubCategoryController::class);
    Route::get('/subcategory/restore/view', [SubCategoryController::class, 'subcategoryview'])->name('subcategory.restore.view');
    Route::get('/subcategory/restore/{id}', [SubCategoryController::class, 'subcategoryrestore'])->name('subcategory.restore');
    Route::get('/subcategory/forcedelete/{id}', [SubCategoryController::class, 'forcedelete'])->name('subcategory.forcedelete');

    // City Controller 
    Route::resource('city', CityController::class);
    Route::get('/city/restore/view', [CityController::class, 'cityrestoreview'])->name('city.restore.view');
    Route::get('/city/restore/{id}', [CityController::class, 'cityrestore'])->name('city.restore');
    Route::get('/city/forcedelete/{id}', [CityController::class, 'forcedelete'])->name('city.forcedelete');

    // Expence Controller
    Route::resource('expence', ExpenceController::class);
    Route::get('/expence/restore/view', [ExpenceController::class, 'expencerestoreview'])->name('expence.restore.view');
    Route::get('/expence/restore/{id}', [ExpenceController::class, 'expencerestore'])->name('expence.restore');
    Route::get('/expence/forcedelete/{id}', [ExpenceController::class, 'forcedelete'])->name('expence.forcedelete');

    // Area Controller 
    Route::resource('area', AreaController::class);
    Route::get('/area/restore/view', [AreaController::class, 'arearestoreview'])->name('area.restore.view');
    Route::get('/area/restore/{id}', [AreaController::class, 'arearestore'])->name('area.restore');
    Route::get('/area/forcedelete/{id}', [AreaController::class, 'forcedelete'])->name('area.forcedelete');

    // Brand Controller 
    Route::resource('brand', BrandController::class);
    Route::get('/brand/restore/view', [BrandController::class, 'brandrestoreview'])->name('brand.restore.view');
    Route::get('/brand/restore/{id}', [BrandController::class, 'brandrestore'])->name('brand.restore');
    Route::get('/brand/forcedelete/{id}', [BrandController::class, 'forcedelete'])->name('brand.forcedelete');

    // Unit Controller 
    Route::resource('unit', UnitController::class);
    Route::get('/unit/restore/view', [UnitController::class, 'unitrestoreview'])->name('unit.restore.view');
    Route::get('/unit/restore/{id}', [UnitController::class, 'unitrestore'])->name('unit.restore');
    Route::get('/unit/forcedelete/{id}', [UnitController::class, 'forcedelete'])->name('unit.forcedelete');

    // Product Controller 
    Route::resource('product', ProductController::class);
    Route::get('/product/restore/view', [ProductController::class, 'productrestoreview'])->name('product.restore.view');
    Route::get('/product/restore/{id}', [ProductController::class, 'productrestore'])->name('product.restore');
    Route::get('/product/forcedelete/{id}', [ProductController::class, 'forcedelete'])->name('product.forcedelete');
    Route::get('/product/category/view/{id}', [ProductController::class, 'productcategoryview'])->name('product.category.view');
    Route::get('/product/active/{id}', [ProductController::class, 'active'])->name('product.active');
    Route::get('/product/deactive/{id}', [ProductController::class, 'deactive'])->name('product.deactive');

    // Invoice Controller 
    Route::get('/invoice/view', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/customer/invoice/{id}', [InvoiceController::class, 'customerinvoice'])->name('customer.invoice');
    Route::get('/vendor/invoice/{id}', [InvoiceController::class, 'vendorinvoice'])->name('vendor.invoice');
    Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('invoicestore');
    Route::get('/single/invoice/{id}', [InvoiceController::class, 'singleinvoice'])->name('singleinvoice');
    Route::post('/due/payment', [InvoiceController::class, 'duepayment'])->name('due.payment');
    
    // Order Controller  
    Route::get('/new/order/list', [OrderController::class, 'neworderlist'])->name('new.order');
    Route::get('/received/order', [OrderController::class, 'receivedorder'])->name('received.order');
    Route::get('/delevered/order', [OrderController::class, 'deleveredorder'])->name('delevered.order');
    Route::get('/canceled/order', [OrderController::class, 'canceledorder'])->name('canceled.order');

    Route::get('/received/{id}', [OrderController::class, 'received'])->name('received');
    Route::get('/delevered/{id}', [OrderController::class, 'delevered'])->name('delevered');
    Route::get('/canceled/{id}', [OrderController::class, 'canceled'])->name('canceled');
    
    Route::get('/order/details/{id}', [OrderController::class, 'orderview'])->name('orderdetails');
    Route::post('/order/store', [OrderController::class, 'store'])->name('orderstore');
    Route::get('/customer/order/view/{id}', [OrderController::class, 'customerorderview'])->name('customer.order.view');

    // Vendor Controller 
    Route::resource('vendor', VendorController::class);
    Route::get('/vendor/restore/view', [VendorController::class, 'vendorrestoreview'])->name('vendor.restore.view');
    Route::get('/vendor/restore/{id}', [VendorController::class, 'vendorrestore'])->name('vendor.restore');
    Route::get('/vendor/forcedelete/{id}', [VendorController::class, 'forcedelete'])->name('vendor.forcedelete');

    // purchase controller 
    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase');
    Route::post('/get/vendor/phone', [PurchaseController::class, 'vendorphone'])->name('vendorphone');
    Route::post('/purchase/invoice', [PurchaseController::class, 'purchaseinvoice'])->name('purchase.invoice');
    Route::get('/purchase/invoice/view', [PurchaseController::class, 'invoiceview'])->name('invoiceview');
    Route::get('/purchase/single/invoice/{id}', [PurchaseController::class, 'vendorsingleinvoice'])->name('vendorsingleinvoice');
    Route::post('/get/vendor/due', [PurchaseController::class, 'vendorpreviousdue'])->name('vendorpreviousdue');

    // Report controller 
    Route::get('/vendor/due/list', [ReportController::class, 'vendordue'])->name('vendordue');
    Route::get('/customer/due/list', [ReportController::class, 'customerdue'])->name('customerdue');
    Route::post('/customer/due/payment', [ReportController::class, 'duepayment'])->name('due.payment');
    Route::post('/vendor/due/payment', [ReportController::class, 'duepaymentvendor'])->name('due.payment.vendor');

    // Main slider
    Route::get('/main/slider', [MainSliderController::class, 'index'])->name('slider.index');
    Route::post('/main/slider/store', [MainSliderController::class, 'store'])->name('slider.store');
    Route::get('/main/slider/delete/{id}', [MainSliderController::class, 'delete'])->name('slider.delete');
    Route::get('/main/slider/restore/view', [MainSliderController::class, 'restoreview'])->name('slider.restoreview');
    Route::get('/slider/restore/{id}', [MainSliderController::class, 'sliderrestore'])->name('slider.restore');
    Route::get('/slider/forcedelete/{id}', [MainSliderController::class, 'forcedelete'])->name('slider.forcedelete');

    // Offer 
    Route::get('/offer', [OfferController::class, 'index'])->name('offer.index');
    Route::post('/offer/store', [OfferController::class, 'store'])->name('offer.store');
    Route::get('/offer/delete/{id}', [OfferController::class, 'delete'])->name('offer.delete');
    Route::get('/offer/restore/view', [OfferController::class, 'restoreview'])->name('offer.restoreview');
    Route::get('/offer/restore/{id}', [OfferController::class, 'offerrestore'])->name('offer.restore');
    Route::get('/offer/forcedelete/{id}', [OfferController::class, 'forcedelete'])->name('offer.forcedelete');


    // Checkout Route
    Route::get('/checkout/page', [FrontendController::class, 'checkout'])->name('checkoutpage');
    Route::post('/order/place', [CheckoutController::class, 'orderplace'])->name('order.place');
    
    // Setting Route
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/update', [SettingController::class, 'update'])->name('setting.update');

    // Review
    Route::post('/review/post', [FrontendController::class, 'productreview'])->name('product.review');

});