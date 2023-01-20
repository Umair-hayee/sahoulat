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
Route::group(['middleware' => ['auth', 'activate']], function(){
    Route::group(['prefix' => 'auth'], function(){
        // AJAX REQUEST FOR PROFILE EDITS AND ADD
        Route::post('user/description', [App\Http\Controllers\ProfileController::class, 'addDescription']);
        Route::post('user/profession', [App\Http\Controllers\ProfileController::class, 'addProfession']);
        Route::post('user/skill', [App\Http\Controllers\ProfileController::class, 'addSkill']);
        Route::post('user/education', [App\Http\Controllers\ProfileController::class, 'addEducation']);
        Route::post('user/certificate', [App\Http\Controllers\ProfileController::class, 'addCertificate']);
        Route::post('user/gig', [App\Http\Controllers\ProfileController::class, 'addGig']);
        Route::post('user/pause-gig', [App\Http\Controllers\ProfileController::class, 'pauseGig']);
        Route::post('user/resume-gig', [App\Http\Controllers\ProfileController::class, 'resumeGig']);
        Route::get('user/paused-gigs/list', [App\Http\Controllers\ProfileController::class, 'pausedGigsList']);
        Route::get('user/active-gigs/list', [App\Http\Controllers\ProfileController::class, 'activeGigsList']);
        // NO AJAX FOR LANGUAGE
        Route::post('user/add-language', [App\Http\Controllers\ProfileController::class, 'addLanguage'])->name('add.language');
        // SETTINGS PAGE ROUTES
        Route::get('user/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
        Route::post('user/settings', [App\Http\Controllers\SettingsController::class, 'storeProfileSettings'])->name('store.profile.settings');
        Route::post('user/set-password', [App\Http\Controllers\SettingsController::class, 'setPassword'])->name('set.password');
        Route::post('user/deactivate-account', [App\Http\Controllers\SettingsController::class, 'deactivateAccount']);
    });
});