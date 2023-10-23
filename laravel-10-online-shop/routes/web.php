<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DiscountCodeController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\Admin\TempImagesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', [FrontController::class, 'index'])->name('front.home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}', [ShopController::class, 'index'])->name('shop.home');
Route::get('/product/{slug}', [ShopController::class, 'product'])->name('front.product');
Route::get('/cart', [CartController::class, 'cart'])->name('front.cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('front.addToCart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('front.updateCart');
Route::post('/delete-cart', [CartController::class, 'deleteItem'])->name('front.deleteItem');

Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');
Route::get('/thanks/{orderId}', [CartController::class, 'thankYou'])->name('front.thankYou');
Route::post('/process-checkout', [CartController::class, 'processCheckout'])->name('front.processCheckout');
Route::post('/get-order0summery', [CartController::class, 'getOrderSummery'])->name('front.getOrderSummery');
Route::post('/send-contact-email', [FrontController::class, 'sendContactEmail'])->name('front.sendContactEmail');


//Apply Discount
Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('front.applyDiscount');
Route::post('/remove-discount', [CartController::class, 'removeCoupon'])->name('front.removeCoupon');
Route::post('/add-to-wishlist', [FrontController::class, 'addToWishlist'])->name('front.addToWishlist');

Route::get('/page/{slug}', [FrontController::class, 'getPage'])->name('front.getPage');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('front.forgotPassword');
Route::post('/process-forgot-password', [AuthController::class, 'processForgotPassword'])->name('front.processForgotPassword');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('front.resetPassword');
Route::post('/process-reset-password', [AuthController::class, 'processResetPassword'])->name('front.processResetPassword');





Route::group(['prefix' => 'account'], function (){
    Route::group(['middleware' => 'guest'], function (){
        Route::get('/register', [AuthController::class, 'register'])->name('account.register');
        Route::get('/login', [AuthController::class, 'login'])->name('account.login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('account.authenticate');
        Route::post('/process-register', [AuthController::class, 'processRegister'])->name('account.processRegister');


    });

    Route::group(['middleware' => 'auth'], function (){
        Route::get('/profile', [AuthController::class, 'profile'])->name('account.profile');
        Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('account.updateProfile');
        Route::post('/update-address', [AuthController::class, 'updateAddress'])->name('account.updateAddress');
        Route::get('/logout', [AuthController::class, 'logout'])->name('account.logout');
        Route::get('/my-orders', [AuthController::class, 'orders'])->name('account.orders');
        Route::get('/order-detail/{id}', [AuthController::class, 'orderDetail'])->name('account.orderDetail');
        Route::post('/remove-product-from-wishlist', [AuthController::class, 'removeProductFromWishlist'])->name('account.removeProductFromWishlist');
        Route::get('/my-wishlist', [AuthController::class, 'wishList'])->name('account.wishList');
        Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('account.showChangePasswordForm');
        Route::get('/process-change-password', [AuthController::class, 'changePassword'])->name('account.changePassword');

    });
});

Route::group(['prefix' => 'admin'], function (){
    Route::group(['middleware' => 'admin.guest'], function (){
        Route::get('/login', [AdminController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware' => 'admin.auth'], function (){
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

        // Category Routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');


        //Sub Categories Routes

        Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('subcategories.index');
        Route::get('/sub-categories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
        Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('subcategories.store');
        Route::get('/sub-categories/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
        Route::put('/sub-categories/{subcategory}', [SubCategoryController::class, 'update'])->name('subcategories.update');
        Route::delete('/sub-categories/{subcategory}', [SubCategoryController::class, 'destroy'])->name('subcategories.delete');


        //Brand Routes

        Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
        Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
        Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
        Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.delete');


        // Product Routes

        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::get('/product-subcategories', [ProductSubCategoryController::class, 'index'])->name('product-subcategories.index');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');
        Route::get('/get-products', [ProductController::class, 'getProducts'])->name('products.getProducts');


        //Shipping Routes

        Route::get('/shipping/create', [ShippingController::class, 'create'])->name('shipping.create');
        Route::post('/shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
        Route::get('/shipping/{shippingId}', [ShippingController::class, 'edit'])->name('shipping.edit');
        Route::put('/shipping/{shippingId}', [ShippingController::class, 'update'])->name('shipping.update');
        Route::delete('/shipping/{shippingId}', [ShippingController::class, 'destroy'])->name('shipping.destroy');


        //Coupon Code Routes

        Route::get('/coupons/create', [DiscountCodeController::class, 'create'])->name('coupons.create');
        Route::post('/coupons', [DiscountCodeController::class, 'store'])->name('coupons.store');
        Route::get('/coupons', [DiscountCodeController::class, 'index'])->name('coupons.index');
        Route::get('/coupons/{coupon}/edit', [DiscountCodeController::class, 'edit'])->name('coupons.edit');
        Route::put('/coupons/{coupon}', [DiscountCodeController::class, 'update'])->name('coupons.update');
        Route::delete('/coupons/{coupon}', [DiscountCodeController::class, 'destroy'])->name('coupons.delete');

        //Orders Routes

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'detail'])->name('orders.detail');
        Route::post('/order/change-status/{id}', [OrderController::class, 'changeOrderStatus'])->name('order.changeOrderStatus');
        Route::post('/order/send-invoice-email/{id}', [OrderController::class, 'sendInvoiceEmail'])->name('orders.sendInvoiceEmail');


        //Users Routes

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');


        //Pages Routes

        Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('pages.delete');

        //Setting Routes
        Route::get('/setting', [SettingController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        Route::post('/change-password', [SettingController::class, 'changePassword'])->name('admin.changePassword');



        // temp-images.create

        Route::post('/upload-temp-images', [TempImagesController::class, 'create'])->name('temp-images.create');
        Route::post('/product-images/update', [ProductImageController::class, 'update'])->name('product-images.update');
        Route::delete('/product-images', [ProductImageController::class, 'destroy'])->name('product-images.destroy');
        Route::get('/getSlug',function (Request $request){
            $slug = '';
                if(!empty($request->title))
                {
                    $slug = Str::slug($request->title);
                }
                return response()->json([
                    'status' => true,
                    'slug' => $slug
                ]);
        })->name('getSlug');

    });
});
