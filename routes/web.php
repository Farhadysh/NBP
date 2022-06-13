<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    // return what you want
});

Route::name('home.')->namespace('Home')->group(function () {
    Route::get('/ajaxProvince/{province}', 'ProvinceController@getCities');
    Route::get('/ajaxCategories/{category}', 'CategoryController@ajaxCategories');
    Route::post('/comments', 'CommentController@store')->name('comments.store');

});

Route::get('/', 'Admin\ShopController@index')->name('index');
Route::get('/agent', 'IndexController@index')->name('agent');

Route::post('/storeContact', 'IndexController@storeContact')->name('storeContact');

Route::get('/user-register', function () {
    return view('auth.small_register');
});

Route::get('/customer_register', function () {
    $provinces = \App\Province::all();
    return view('auth.customer_register', [
        'provinces' => $provinces,
        'title' => 'ثبت نام به عنوان فروشنده'
    ]);
});

Route::get('/customers_club', function () {
    return view('customer', [
        'title' => 'باشگاه مشتریان'
    ]);
});

Route::get('/about', function () {
    return view('about-us');
});

Route::get('/roles', function () {
    return view('roles');
});

Route::get('/contact', function () {
    return view('contact-us', [
        'title' => 'تماس با ما'
    ]);
});

Route::name('digitalMarket.')->prefix('digitalMarketing')->group(function () {
    Route::name('index')->get('/', function () {
        return view('digital-marketing.index', ['title' => 'فروشگاه محتوا']);
    });

    Route::name('sms')->get('/sms', function () {
        return view('digital-marketing.sms', [
            'title' => 'پنل پیامکی'
        ]);
    });

    Route::name('discountCart')->get('/discountCart', function () {
        return view('digital-marketing.discountCart', [
            'title' => 'کارت تخفیف'
        ]);
    });

    Route::name('visitCart')->get('/visitCart', function () {
        return view('digital-marketing.visitCart', [
            'title' => 'کارت ویزیت'
        ]);
    });

    Route::get('/digital-market/library', 'DigitalMarketController@library')->name('library');
    Route::get('/digital-market/showBook/{id}', 'DigitalMarketController@showBook')->name('library.showBook');

});

Route::name('user.')->namespace('Admin')->middleware('auth:web')->prefix('user')->group(function () {
    Route::name('study')->get('/study', function () {
        return view('homePages.study');
    });

    Route::get('/positions', 'PositionController@index');
    Route::get('/positions/{position}/active', 'PositionController@active');
    Route::get('/positions/{PlanUser}/edit', 'PositionController@edit');
    Route::post('/positions/store', 'PositionController@store');

    Route::get('/positions/lists', 'PositionController@lists');

    Route::post('/checkouts', 'CheckoutController@store');

    Route::post('/orders/shopPayment', 'OrderController@shopPayment')->name('orders.shopPayment');
    Route::get('/orders/store', 'OrderController@store')->name('orders.store');
    Route::post('/profileImage', 'UserController@profileImage')->name('profileImage');
    Route::get('/profileEdit', 'UserController@profileEdit')->name('profileEdit');
    Route::post('/profileUpdate/{user}', 'UserController@profileUpdate')->name('profileUpdate');
    Route::post('/changePassword/{user}', 'UserController@changePassword')->name('changePassword');
    Route::get('/packageList', 'PackageListController@index')->name('packageList.index');
    Route::resource('packageList', 'PackageListController');
    Route::get('/packageCart/{Product}', 'PackageCartController@cart');
    Route::post('/cart', 'CartController@store');
    Route::get('/packageCart/count/{cart_id}/{count}', 'PackageCartController@count');
    Route::get('/cart/count/{cart_id}/{count}', 'CartController@count');
    Route::get('/packageCart/destroy/{delete_id}', 'PackageCartController@destroy');
    Route::get('/cart/destroy/{delete_id}', 'CartController@destroy');
//    Route::get('/packageCart/final/store', 'PackageCartController@store');
    Route::get('/homePage', 'HomePageController@index');
    Route::get('/homePage/sms/{PlanUser}', 'HomePageController@smsIndex');
    Route::get('/homePage/discountCart', 'HomePageController@discountCart');
    Route::get('/homePage/visitCart/{PlanUser}', 'HomePageController@visitCart');
    Route::resource('discountCarts', 'DiscountCartController');
    Route::get('/homePage/library', 'HomePageController@library');
    Route::post('/homePage/register_sms', 'HomePageController@register_sms')->name('register_sms');
    Route::resource('libraries', 'LibraryController');
    Route::get('checkouts', 'CheckoutController@userIndex')->name('checkouts.userIndex');
    Route::resource('visitCarts', 'VisitCartController');
    Route::get('/walletRequest', 'UserController@walletRequest')->name('walletRequest');
    Route::get('/showOrders/{id}/{slug}', 'OrderController@showOrders')->name('showOrders');
    Route::get('/ajaxProvince/{id}', 'OrderController@ajaxProvince');
    Route::get('/orderList/{order}', 'OrderController@orderList')->name('orderList');

    Route::get('/homepage/commission', 'CheckoutController@userCommission')->name('commissions.userCommission');

    Route::get('/introducing', 'IntroducingController@index');

    Route::get('/myPackages', 'HomePageController@myPackages');

    Route::get('/plans', 'UserPlanController@index');
    Route::get('/plans/store/{id}', 'UserPlanController@store');

    Route::get('/orders', 'OrderController@userOrders');
    Route::get('/factor/{id}', 'OrderController@userFactor');
});

Route::post('/plans/store', 'Home\PlanController@store');
Route::get('/plans/addToCart/{plan}', 'Home\PlanController@addToCart');
Route::get('/plans/payments', 'Home\PlanController@showPlanPayment');
Route::get('/plans/removeCart/{plan}', 'Home\PlanController@removeCart');
Route::get('/plans', 'Admin\PlanController@index');

Route::name('admin.')->namespace('Admin')->middleware(['auth:web', 'admin'])->prefix('admin')->group(function () {
    Route::name('index')->get('/', function () {
        return view('admin.index');
    });

    Route::resource('brands', 'BrandController');

    Route::resource('contacts', 'ContactController')->only('index');

    Route::get('/destroy_image/{id}', 'ProductController@destroy_image')->name('products.destroy_image');
    Route::get('/active/{id}', 'ProductController@active')->name('products.active');
    Route::get('/ajaxCategories/{id}', 'ProductController@ajaxCategories')->name('ajaxCategories');
    Route::get('products/search', 'ProductController@search')->name('products.search');
    Route::get('/products/special/{product}', 'ProductController@special');
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::get('/plan', 'UserController@plan')->name('users.plan');
    Route::get('/search', 'UserController@search')->name('users.search');
    Route::get('/showChild/{id}', 'UserController@showChild')->name('users.showChild');
    Route::post('/addWallet', 'UserController@addWallet')->name('users.addWallet');
    Route::post('/users/addPlan', 'UserController@addPlan');
    Route::resource('users', 'UserController');
    Route::resource('packages', 'PackageController');
    Route::get('packageCart/adminStore', 'PackageCartController@adminStore')->name('packageCarts.adminStore');
    Route::get('packageCart/withOutPackages', 'PackageCartController@withOutPackages')->name('packageCart.withOutPackages');
    Route::get('packages/indexAdmin/{id}', 'PackageListController@indexAdmin')->name('packages.indexAdmin');
    Route::get('tickets.seen/{contact}', 'TicketController@seen')->name('tickets.seen');
    Route::resource('tickets', 'TicketController');
    Route::get('discountCarts.seen/{discountCart}', 'DiscountCartController@seen')->name('discountCarts.seen');
    Route::resource('discountCarts', 'DiscountCartController');
    Route::resource('libraries', 'LibraryController');
    Route::get('visitCarts.seen/{visitCart}', 'VisitCartController@seen')->name('visitCarts.seen');
    Route::resource('visitCarts', 'VisitCartController');
    Route::get('orders/search', 'OrderController@search')->name('orders.search');
    Route::get('/factor/{id}', 'OrderController@factor')->name('orders.factor');
    Route::get('/changeStatus/{id}/{status}', 'OrderController@changeStatus')->name('orders.changeStatus');
    Route::get('/orders/changeStatus/{id}/{status}', 'OrderController@changeStatus')->name('orders.changeStatus');
    Route::get('/orders/changeClear/{id}/{status}', 'OrderController@changeClear')->name('orders.changeClear');
    Route::resource('orders', 'OrderController');

    Route::get('/plans/buys', 'PlanController@buy');
    Route::resource('plans', 'PlanController');

    Route::resource('planUsers', 'PlanUserController');

    Route::get('/checkouts/seller', 'CheckoutAdminController@seller')->name('checkouts.seller');
    Route::resource('checkouts', 'CheckoutAdminController');

    Route::get('/tree', 'TreeController@index');

    Route::get('/products/approved/{product}', 'ProductController@approved')->name('products.approved');
    Route::get('/products/unapproved/{product}', 'ProductController@unapproved')->name('products.cause');
    Route::post('/products/unapproved', 'ProductController@unapprovedStore')->name('products.unapprovedStore');

    Route::resource('tags', 'TagController');

    Route::get('/tickets/{ticket}/close', 'TicketController@close')->name('tickets.close');
    Route::resource('tickets', 'TicketController');

    Route::resource('replies', 'ReplyController')->only(['store']);

    Route::get('/comments', 'CommentController@index')->name('comments.index');
    Route::get('/comments/approved/{comment}', 'CommentController@approved')->name('comments.approved');
    Route::get('/comments/destroy/{comment}', 'CommentController@destroy')->name('comments.destroy');

    Route::get('/seller/best/{user}', 'UserController@bestSeller');

    Route::resource('roles', 'RoleController');

    Route::get('/discounts/payments', 'DiscountController@paymentLists');
    Route::resource('discounts', 'DiscountController');

});

//->middleware(['auth:web', 'seller'])
Route::name('panel.')->namespace('Panel')->prefix('panel')->middleware(['auth:web', 'isSeller'])->group(function () {
    Route::get('/', 'PanelController@homePanel')->name('index');

    Route::get('/products/search', 'ProductController@search')->name('products.search');
    Route::get('/products/active/{id}', 'ProductController@active')->name('products.active');
    Route::get('/destroy_image/{id}', 'ProductController@destroy_image')->name('products.destroy_image');

    Route::get('/products/unconfirmed', 'ProductController@unconfirmed')
        ->name('products.unconfirmed');
    Route::resource('products', 'ProductController');

    Route::get('/factor/{id}', 'OrderController@factor')->name('orders.factor');

    Route::get('/orders/search', 'OrderController@search')->name('orders.search');
    Route::get('/orders/send/{order}', 'OrderController@send');
    Route::resource('orders', 'OrderController');

    Route::get('/tickets/{ticket}/close', 'TicketController@close')->name('tickets.close');
    Route::resource('tickets', 'TicketController');

    Route::resource('replies', 'ReplyController')->only(['store']);

    Route::resource('checkouts', 'CheckoutController');

    Route::get('/comments', 'CommentController@index')->name('comments.index');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@store')->name('profile.store');
});

Route::name('shopping.')->namespace('Admin')->prefix('shop')->group(function () {
    Route::get('/', 'ShopController@index')->name('index');
    Route::get('/categories', 'ShopController@categories')->name('categories');
    Route::get('/categories/{categorySlug}', 'ShopController@subCategories')->name('subCategories');
    Route::get('/allProducts/{id}', 'ShopController@allProducts')->name('allProducts');
    Route::get('/search', 'ShopController@search')->name('search');
    Route::resource('products', 'ProductController');
    Route::resource('orders', 'OrderController');
});

Route::get('/user/packageCart/final/sendPayment', 'Admin\PackageCartController@sendPayment');
Route::get('/payments/result', 'IndexController@storePayment');

Route::get('/packageCart/final/store', 'IndexController@storePackage');

Route::get('/plan/payments/callback', 'IndexController@storePlan');

Auth::routes();

Route::get('/plans', 'Home\PlanController@index');

Route::get('/user/discount/payment', 'Admin\DiscountCartController@payment');

Route::get('/user/discounts/payment/{discount}', 'Admin\DiscountController@payment');
Route::any('/user/discounts/callback', 'Admin\DiscountController@callback');
Route::get('/brands', 'BrandController@index');


Route::get('/password/forget', 'AuthController@showForgetForm');
Route::post('/password/verifyMobile', 'AuthController@verifyMobile');
Route::get('/password/verify', 'AuthController@showVerifyForm');
Route::post('/password/verify', 'AuthController@verify');

Route::get('/password/reset', 'AuthController@showResetForm');
Route::get('/password/resend', 'AuthController@resend');
Route::post('/password/reset', 'AuthController@reset');