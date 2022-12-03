<?php

use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

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

//guest: contact
Route::get('contact',function(){
   return view('contact');
})->name('guest.contact');
Route::post('contact/update', [App\Http\Controllers\ContactController::class, 'update'])->middleware(ProtectAgainstSpam::class)
    ->name('contact.update');

//guest: about
Route::get('about', function(){
    return view('about');
})->name('guest.about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])->group( function(){

    //admin: about sections
    Route::get('admin/about', [App\Http\Controllers\Admin\AboutController::class, 'index'])
        ->name('admin.about');
    Route::get('admin/about/edit/{about}', [App\Http\Controllers\Admin\AboutController::class, 'edit'])
        ->name('admin.about.edit');
    Route::post('admin/about/add', [App\Http\Controllers\Admin\AboutController::class, 'store'])
        ->name('admin.about.store');
    Route::post('admin/about/update/{about}', [App\Http\Controllers\Admin\AboutController::class, 'update'])
        ->name('admin.about.update');

    //admin: accepted participants
    Route::get('admin/accepted/{user}', [App\Http\Controllers\Admin\Rosters\AcceptedController::class, 'update'])
        ->name('admin.accept');

    //admin: change password
    Route::get('admin/changepw', [App\Http\Controllers\Admin\ChangePasswordController::class, 'index'])
        ->name('admin.changePassword');

    //admin: event management
    Route::get('admin/events', [App\Http\Controllers\Admin\EventsController::class, 'index'])
        ->name('admin.events');
    Route::get('admin/events/destroy/{event}', [App\Http\Controllers\Admin\EventsController::class, 'destroy'])
        ->name('admin.events.destroy');
    Route::get('admin/events/edit/{event}', [App\Http\Controllers\Admin\EventsController::class, 'edit'])
        ->name('admin.events.edit');
    Route::post('admin/events/add', [App\Http\Controllers\Admin\EventsController::class, 'store'])
        ->name('admin.events.store');
    Route::post('admin/events/update/{event}', [App\Http\Controllers\Admin\EventsController::class, 'update'])
        ->name('admin.events.update');

    //admin: invitation
    Route::get('admin/invite/{user}', App\Http\Controllers\Admin\InvitationController::class)
        ->name('admin.invite');

    //admin: log In as
    Route::get('admin/loginAs', [App\Http\Controllers\Admin\LoginAsController::class, 'index'])
        ->name('admin.loginAs');

    //admin: main menu
    Route::get('admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])
        ->name('admin.index');

    //admin: pending emails
    Route::get('admin/pendingemails', [App\Http\Controllers\Admin\PendingemailController::class, 'index'])
        ->name('admin.pendingemails');
    Route::get('admin/pendingemails/remove/{pendingemail}', [App\Http\Controllers\Admin\PendingemailController::class, 'destroy'])
        ->name('admin.pendingemails.remove');
    Route::get('admin/pendingemails/send/{pendingemail?}', [App\Http\Controllers\Admin\PendingemailController::class, 'update'])
        ->name('admin.pendingemails.update');

    //admin: rosters: applicants
    Route::get('rosters/applicants', [App\Http\Controllers\Admin\Rosters\ApplicantController::class, 'index'])
        ->name('admin.rosters.applicants');
    Route::get('rosters/applicants/downloads', [App\Http\Controllers\Admin\Rosters\ApplicantController::class, 'export'])
        ->name('admin.rosters.applicants.download');
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
    Route::get('rosters/membership/add', [App\Http\Controllers\Admin\Rosters\MembershipController::class, 'create'])
        ->name('admin.rosters.membership.add');
    Route::get('rosters/membership/edit/{user}', [App\Http\Controllers\Admin\Rosters\MembershipController::class, 'edit'])
        ->name('admin.rosters.membership.edit');
    Route::post('rosters/membership/save', [App\Http\Controllers\Admin\Rosters\MembershipController::class, 'store'])
        ->name('admin.rosters.membership.store');
    Route::post('rosters/membership/update/{user}', [App\Http\Controllers\Admin\Rosters\MembershipController::class, 'update'])
        ->name('admin.rosters.membership.update');

    //user: application
    Route::get('user/application', [App\Http\Controllers\User\ApplicationController::class,'edit'])
        ->name('user.application.edit');
    Route::post('application/update', [App\Http\Controllers\User\ApplicationController::class, 'update'])
        ->name('user.application.update');
    Route::get('user/application/ensemble/remove/{ensemble}',[App\Http\Controllers\User\ApplicationController::class,'destroy'])
        ->name('user.application.ensemble.destroy');
    Route::get('user/application/pdf', [App\Http\Controllers\User\ApplicationController::class, 'pdf'])
        ->name('user.application.pdf');

    //user: accepted: PROFILE
    Route::get('user/profile', [App\Http\Controllers\User\Accepteds\ProfileController::class, 'show'])
        ->name('users.accepteds.profiles.show');
    Route::post('user/profile/update', [App\Http\Controllers\User\Accepteds\ProfileController::class, 'update'])
        ->name('users.accepteds.profiles.update');

    //user: accepted: SCHOOL
    Route::get('user/school', [App\Http\Controllers\User\Accepteds\SchoolController::class, 'show'])
        ->name('users.accepteds.schools.show');
    Route::post('user/school/update/{school}', [App\Http\Controllers\User\Accepteds\SchoolController::class, 'update'])
        ->name('users.accepteds.schools.update');

    //user: about
    Route::get('user/about', function(){
        return view('users.about.show');
    })->name('user.about');

    //user: contact
    Route::get('user/contact',function(){
        return view('users.contact.show');
    })->name('user.contact');
    Route::post('user/contact/update', [App\Http\Controllers\ContactController::class, 'update'])->middleware(ProtectAgainstSpam::class)
        ->name('user.contact.update');
});

require __DIR__.'/auth.php';
