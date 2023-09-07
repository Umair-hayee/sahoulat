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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('reset/success', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetSuccess'])->name('reset.success');
// ROUTE FOR REGISTERTAION
Route::post('register/user', [\App\Http\Controllers\Auth\RegisterController::class, 'registerUser'])->name('register.user');
Route::get('confirm/email/{email}', [\App\Http\Controllers\Auth\RegisterController::class, 'confirmEmail'])->name('confirm.email');
// FORGOT MY ROUTE
Route::post('forgot-password/email', [App\Http\Controllers\ForgotPasswordController::class, 'forgotPassword'])->name('forgot.email');
Route::get('user/password/reset/form', [App\Http\Controllers\ForgotPasswordController::class, 'passwordResetLinkForm'])->name('reset.link.form');
Route::post('registered/password/reset', [App\Http\Controllers\ForgotPasswordController::class, 'passwordReset'])->name('registered.password.reset');
Route::get('resend/password/reset/link/{email}', [\App\Http\Controllers\ForgotPasswordController::class, 'resendLink'])->name('resend.email.link');
Route::get('google/redirect', [App\Http\Controllers\SocialController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('google/callback', [App\Http\Controllers\SocialController::class, 'handleGoogleCallback']);
// SELLER ROUTES GOES HERE
Route::group(['middleware' => ['auth', 'activate', 'role:Seller']], function(){
    Route::group(['prefix' => 'seller'], function(){
        Route::get('/dashboard', [App\Http\Controllers\Seller\DashboardController::class, 'index'])->name('seller.dashboard');
        // AJAX REQUEST FOR PROFILE EDITS AND ADD
        Route::post('/description', [App\Http\Controllers\ProfileController::class, 'addDescription']);
        Route::post('/profession', [App\Http\Controllers\ProfileController::class, 'addProfession']);
        Route::post('/skill', [App\Http\Controllers\ProfileController::class, 'addSkill']);
        Route::post('/education', [App\Http\Controllers\ProfileController::class, 'addEducation']);
        Route::post('/certificate', [App\Http\Controllers\ProfileController::class, 'addCertificate']);
        Route::post('/gig', [App\Http\Controllers\ProfileController::class, 'addGig']);
        Route::post('/pause-gig', [App\Http\Controllers\ProfileController::class, 'pauseGig']);
        Route::post('/resume-gig', [App\Http\Controllers\ProfileController::class, 'resumeGig']);
        Route::get('/paused-gigs/list', [App\Http\Controllers\ProfileController::class, 'pausedGigsList']);
        Route::get('/active-gigs/list', [App\Http\Controllers\ProfileController::class, 'activeGigsList']);
        // NO AJAX FOR LANGUAGE
        Route::post('/add-language', [App\Http\Controllers\ProfileController::class, 'addLanguage'])->name('add.language');
        // SETTINGS PAGE ROUTES
        Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [App\Http\Controllers\SettingsController::class, 'storeProfileSettings'])->name('store.profile.settings');
        Route::post('/set-password', [App\Http\Controllers\SettingsController::class, 'setPassword'])->name('set.password');
        Route::post('/deactivate-account', [App\Http\Controllers\SettingsController::class, 'deactivateAccount']);
        // AJAX FOR NOTIFICATIONS
        Route::post('/inbox-notifications', [App\Http\Controllers\SettingsController::class, 'inboxNotifications']);
        Route::post('/order-notifications', [App\Http\Controllers\SettingsController::class, 'orderNotifications']);
        Route::post('/order-update/notifications', [App\Http\Controllers\SettingsController::class, 'orderUpdatesNotifications']);
        Route::post('/rating-reminder/notifications', [App\Http\Controllers\SettingsController::class, 'ratingReminderNotifications']);
        // ORDERS ROUTES
        Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
        Route::post('/search-orders', [App\Http\Controllers\OrderController::class, 'searchOrders']);
        // EARNING ROUTES
        Route::get('/earnings', [App\Http\Controllers\EarningController::class, 'index'])->name('earnings.index');
        Route::post('/search-earnings', [App\Http\Controllers\EarningController::class, 'search']);
        Route::post('/notifications', [App\Http\Controllers\SettingsController::class, 'notifications'])->name('seller.notifications');
        Route::post('/phone-verification', [App\Http\Controllers\SettingsController::class, 'phoneVerification'])->name('seller.phone.verification');
        Route::get('/mark/order/{id}/complete', [App\Http\Controllers\OrderController::class, 'markAsComplete'])->name('mark.as.complete');
        Route::post('/sub-tags', [App\Http\Controllers\Seller\DashboardController::class, 'subTags'])->name('sub.tags');
    });
});

// BUYER ROUTES GOES HERE
Route::group(['middleware' => ['auth', 'activate', 'role:Buyer']], function(){
    Route::group(['prefix' => 'buyer'], function(){
        Route::get('/dashboard', [App\Http\Controllers\Buyer\DashboardController::class, 'index'])->name('buyer.dashboard');
        Route::post('/description', [App\Http\Controllers\Buyer\ProfileController::class, 'addDescription']);
        Route::post('/profession', [App\Http\Controllers\Buyer\ProfileController::class, 'addProfession']);
        Route::post('/skill', [App\Http\Controllers\Buyer\ProfileController::class, 'addSkill']);
        Route::post('/education', [App\Http\Controllers\Buyer\ProfileController::class, 'addEducation']);
        Route::post('/certificate', [App\Http\Controllers\Buyer\ProfileController::class, 'addCertificate']);
        // SETTINGS SCREEN ROUTES
        Route::get('/settings', [App\Http\Controllers\Buyer\SettingsController::class, 'index'])->name('buyer.settings.index');
        Route::post('/settings', [App\Http\Controllers\Buyer\SettingsController::class, 'storeProfileSettings'])->name('buyer.store.profile.settings');
        Route::post('/set-password', [App\Http\Controllers\Buyer\SettingsController::class, 'setPassword'])->name('buyer.set.password');
        Route::post('/deactivate-account', [App\Http\Controllers\Buyer\SettingsController::class, 'deactivateAccount'])->name('buyer.deactivate.account');
        // AJAX FOR NOTIFICATIONS
        Route::post('/inbox-notifications', [App\Http\Controllers\Buyer\SettingsController::class, 'inboxNotifications']);
        Route::post('/order-notifications', [App\Http\Controllers\Buyer\SettingsController::class, 'orderNotifications']);
        Route::post('/order-update/notifications', [App\Http\Controllers\Buyer\SettingsController::class, 'orderUpdatesNotifications']);
        Route::post('/rating-reminder/notifications', [App\Http\Controllers\Buyer\SettingsController::class, 'ratingReminderNotifications']);
        Route::post('/verify/phone-number', [App\Http\Controllers\Buyer\SettingsController::class, 'phoneVerification']);
        // ORDERS ROUTES
        Route::get('/orders', [App\Http\Controllers\Buyer\OrdersController::class, 'index'])->name('buyer.orders.index');
        Route::post('/search-orders', [App\Http\Controllers\Buyer\OrdersController::class, 'searchOrders']);
        Route::post('/notifications', [App\Http\Controllers\Buyer\SettingsController::class, 'notifications'])->name('buyer.notifications');
        Route::get('home', [App\Http\Controllers\Buyer\DashboardController::class, 'home'])->name('buyer.home');
        Route::post('search-gig', [App\Http\Controllers\Buyer\DashboardController::class, 'searchGig'])->name('buyer.search.gig');
        Route::post('/store/order', [App\Http\Controllers\Buyer\DashboardController::class, 'storeOrder'])->name('create.order');
        Route::get('/create/order/{id}', [App\Http\Controllers\Buyer\DashboardController::class, 'createOrder'])->name('order.creation');
        Route::get('/tag/{id}/search-gig', [App\Http\Controllers\Buyer\DashboardController::class, 'searchGigByTag'])->name('buyer.search.gig.tag');
        Route::get('/pending-orders', [App\Http\Controllers\Buyer\DashboardController::class, 'pendingOrders']);
        Route::get('/completed-orders', [App\Http\Controllers\Buyer\DashboardController::class, 'completedOrders']);
    });
});

// ADMIN ROUTES
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'loginForm']);
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login');
Route::group(['middleware' => ['auth']], function(){
    Route::group(['prefix' => 'admin'], function(){
        Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('users', [App\Http\Controllers\AdminController::class, 'usersList'])->name('admin.users.list');
        Route::get('/deactivate-user/{id}', [App\Http\Controllers\AdminController::class, 'deactivateUser'])->name('deactivate.user');
        Route::get('/activate-user/{id}', [App\Http\Controllers\AdminController::class, 'activateUser'])->name('activate.user');
        Route::get('/users/chat', [App\Http\Controllers\AdminController::class, 'usersChat'])->name('admin.users.chat');
        Route::get('/users/orders', [App\Http\Controllers\AdminController::class, 'usersOrders'])->name('admin.orders');
    });
});

Route::get('policy', function(){
    return view('policy');
});