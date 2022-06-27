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

Route::get('/', function () {
    return view('welcome');
})->name('guest.home');

Route::get('contact',function(){
   return view('contact');
})->name('guest.contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])->group( function(){

    //admin: accepted participants
    Route::get('admin/accepted/{user}', [App\Http\Controllers\Admin\Rosters\AcceptedController::class, 'update'])
        ->name('admin.accept');

    //admin: main menu
    Route::get('admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])
        ->name('admin.index');

    //admin: invitation
    Route::get('admin/invite/{user}', App\Http\Controllers\Admin\InvitationController::class)
        ->name('admin.invite');

    //admin: pending emails
    Route::get('admin/pendingemails', [App\Http\Controllers\Admin\PendingemailController::class, 'index'])
        ->name('admin.pendingemails');
    Route::get('admin/pendingemails/remove/{pendingemail}', [App\Http\Controllers\Admin\PendingemailController::class, 'destroy'])
        ->name('admin.pendingemails.remove');
    Route::get('admin/pendingemails/send/{pendingemail?}', [App\Http\Controllers\Admin\PendingemailController::class, 'update'])
        ->name('admin.pendingemails.update');

    //admin: rosters: accepted
    Route::get('rosters/accepteds', [App\Http\Controllers\Admin\Rosters\AcceptedController::class, 'index'])
        ->name('admin.rosters.accepteds');

    //admin: rosters: invitation
    Route::get('rosters/invitations', [App\Http\Controllers\Admin\Rosters\InvitationController::class, 'index'])
        ->name('admin.rosters.invitations');

    //admin: rosters: menu
    Route::get('rosters', [App\Http\Controllers\Admin\Rosters\RostersController::class, 'index'])
        ->name('admin.rosters');

    //admin: rosters: membership
    Route::get('rosters/membership', [App\Http\Controllers\Admin\Rosters\MembershipController::class, 'index'])
        ->name('admin.rosters.membership');
});

require __DIR__.'/auth.php';
