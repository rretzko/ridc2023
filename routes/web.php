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

    //admin: downloads
    Route::get('admin/downloads', [App\Http\Controllers\Admin\Downloads\DownloadController::class, 'index'])
        ->name('admin.downloads');
    Route::get('admin/downloads/equipment', [App\Http\Controllers\Admin\Downloads\DownloadController::class, 'equipment'])
        ->name('admin.downloads.equipment');
    Route::get('admin/downloads/students', [App\Http\Controllers\Admin\Downloads\DownloadController::class, 'students'])
        ->name('admin.downloads.students');
    Route::get('admin/downloads/programFile', [App\Http\Controllers\Admin\Downloads\DownloadController::class, 'programFile'])
        ->name('admin.downloads.programFile');

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

    //admin: recordings
    Route::get('admin/recordings', [App\Http\Controllers\Admin\Recordings\RecordingController::class, 'index'])
        ->name('admin.recordings');
    Route::post('admin/recordings/select', [App\Http\Controllers\Admin\Recordings\RecordingController::class, 'show'])
        ->name('admin.recordings.show');
    Route::get('admin/recordings/delete/{fileUpload}', [App\Http\Controllers\Admin\Recordings\RecordingController::class, 'destroy'])
        ->name('admin.recordings.delete');

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

    //admin: schedules
    Route::get('admin/schedules', [App\Http\Controllers\Admin\Schedules\ScheduleController::class, 'index'])
        ->name('admin.schedules');

    //admin: schedules: ensembles
    Route::get('admin/schedules/ensembles', [App\Http\Controllers\Admin\Schedules\EnsembleController::class, 'index'])
        ->name('admin.schedules.ensembles');
    Route::get('admin/schedules/ensembles/edit', [App\Http\Controllers\Admin\Schedules\EnsembleController::class, 'edit'])
        ->name('admin.schedules.ensembles.edit');
    Route::get('admin/schedules/ensembles/editEnsemble/{ensemble}', [App\Http\Controllers\Admin\Schedules\EnsembleController::class, 'showEnsemble'])
        ->name('admin.schedules.ensembles.showEnsemble');
    Route::get('admin/schedules/ensembles/show', [App\Http\Controllers\Admin\Schedules\EnsembleController::class, 'show'])
        ->name('admin.schedules.ensembles.show');
    Route::get('admin/schedules/ensembles/csv', [App\Http\Controllers\Admin\Schedules\EnsembleController::class, 'csv'])
        ->name('admin.schedules.ensembles.csv');
    Route::post('admin/schedules/ensembles/updateEnsemble/{ensemble}', [App\Http\Controllers\Admin\Schedules\EnsembleController::class, 'updateEnsemble'])
        ->name('admin.schedules.ensembles.updateEnsemble');

    //admin: schedules: soloists
    Route::get('admin/schedules/soloists', [App\Http\Controllers\Admin\Schedules\SoloistController::class, 'index'])
        ->name('admin.schedules.soloists');
    Route::get('admin/schedules/soloists/edit', [App\Http\Controllers\Admin\Schedules\SoloistController::class, 'edit'])
        ->name('admin.schedules.soloists.edit');
    Route::get('admin/schedules/soloists/show', [App\Http\Controllers\Admin\Schedules\SoloistController::class, 'show'])
        ->name('admin.schedules.soloists.show');
    Route::get('admin/schedules/soloists/csv', [App\Http\Controllers\Admin\Schedules\SoloistController::class, 'csv'])
        ->name('admin.schedules.soloists.csv');

    //admin: uploads
    Route::get('admin/uploads', [App\Http\Controllers\Admin\Uploads\UploadController::class, 'index'])
        ->name('admin.uploads');
    Route::get('admin/uploads/seed', [App\Http\Controllers\Admin\Uploads\UploadController::class, 'seed'])
        ->name('admin.uploads.seed');
    Route::post('admin/uploads/store', [App\Http\Controllers\Admin\Uploads\UploadController::class, 'store'])
        ->name('admin.uploads.store');

    //user: application
    Route::get('user/application', [App\Http\Controllers\User\ApplicationController::class,'edit'])
        ->name('user.application.edit');
    Route::post('application/update', [App\Http\Controllers\User\ApplicationController::class, 'update'])
        ->name('user.application.update');
    Route::get('user/application/ensemble/remove/{ensemble}',[App\Http\Controllers\User\ApplicationController::class,'destroy'])
        ->name('user.application.ensemble.destroy');
    Route::get('user/application/pdf', [App\Http\Controllers\User\ApplicationController::class, 'pdf'])
        ->name('user.application.pdf');

    //admin: status
    Route::get('admin/status', [App\Http\Controllers\Admin\Status\StatusController::class, 'index'])
        ->name('admin.status');

    //user: accepteds: APPLICATION
    Route::get('user/application', [App\Http\Controllers\User\Accepteds\Applications\ApplicationController::class, 'show'])
        ->name('users.accepteds.application.show');

    //user: accepteds: ENSEMBLES
    Route::get('user/ensembles', [App\Http\Controllers\User\Accepteds\EnsembleController::class, 'index'])
        ->name('users.accepteds.ensembles.index');
    Route::get('user/ensembles/edit/{ensemble}/{action}', [App\Http\Controllers\User\Accepteds\EnsembleController::class, 'edit'])
        ->name('users.ensembles.edit');
    Route::post('user/ensembles/description/{ensemble}', [App\Http\Controllers\User\Accepteds\Ensembles\DescriptionController::class, 'update'])
        ->name('users.ensembles.description');

    //user: accepted: JUDGING
    Route::get('user/judging', [App\Http\Controllers\User\Accepteds\Judging\JudgingController::class, 'show'])
        ->name('users.accepteds.judging.show');

    //user: accepted: PERSONNEL
    Route::post('user/personnel/update/{school}', [App\Http\Controllers\User\Accepteds\PersonnelController::class, 'update'])
        ->name('users.accepteds.personnel.update');

    //user: accepted: PROFILE
    Route::get('user/profile', [App\Http\Controllers\User\Accepteds\ProfileController::class, 'show'])
        ->name('users.accepteds.profiles.show');
    Route::post('user/profile/update', [App\Http\Controllers\User\Accepteds\ProfileController::class, 'update'])
        ->name('users.accepteds.profiles.update');

    //user: accepteds: REPERTOIRE
    Route::get('user/repertoire/index/{ensemble}', [App\Http\Controllers\User\Accepteds\RepertoireController::class, 'index'])
        ->name('users.repertoire.index');
    Route::get('user/repertoire/create/{ensemble}', [App\Http\Controllers\User\Accepteds\RepertoireController::class, 'create'])
        ->name('users.repertoire.create');
    Route::get('user/repertoire/edit/{repertoire}', [App\Http\Controllers\User\Accepteds\RepertoireController::class, 'edit'])
        ->name('users.repertoire.edit');
    Route::get('user/repertoire/remove/{repertoire}', [App\Http\Controllers\User\Accepteds\RepertoireController::class, 'destroy'])
        ->name('users.repertoire.remove');
    Route::post('user/repertoire/store', [App\Http\Controllers\User\Accepteds\RepertoireController::class, 'store'])
        ->name('users.repertoire.store');
    Route::post('user/repertoire/update/{repertoire}', [App\Http\Controllers\User\Accepteds\RepertoireController::class, 'update'])
        ->name('users.repertoire.update');

    //user: accepteds: SET-UP
    Route::get('user/setup/edit/{ensemble}', [App\Http\Controllers\User\Accepteds\Ensembles\SetupController::class, 'edit'])
        ->name('users.setup.edit');
    Route::post('user/setup/update/{setup}', [App\Http\Controllers\User\Accepteds\Ensembles\SetupController::class, 'update'])
        ->name('users.setup.update');

    //user: accepted: SCHOOL
    Route::get('user/school', [App\Http\Controllers\User\Accepteds\SchoolController::class, 'show'])
        ->name('users.accepteds.schools.show');
    Route::post('user/school/update/{school}', [App\Http\Controllers\User\Accepteds\SchoolController::class, 'update'])
        ->name('users.accepteds.schools.update');

    //user: accepteds: SOLOISTS
    Route::get('user/soloists/edit', [App\Http\Controllers\User\Accepteds\Soloists\SoloistController::class, 'edit'])
        ->name('users.accepteds.soloists.edit');
    Route::post('user/soloists/update', [App\Http\Controllers\User\Accepteds\Soloists\SoloistController::class, 'update'])
        ->name('users.accepteds.soloists.update');

    //user: accepted: STUDENTS
    Route::get('user/students', [App\Http\Controllers\User\Accepteds\StudentController::class, 'index'])
        ->name('users.accepteds.students.index');
    Route::get('user/students/add', [App\Http\Controllers\User\Accepteds\StudentController::class, 'create'])
        ->name('users.accepteds.students.create');
    Route::post('user/students/save', [App\Http\Controllers\User\Accepteds\StudentController::class, 'store'])
        ->name('users.accepteds.students.store');
    Route::get('user/students/remove/{student}', [App\Http\Controllers\User\Accepteds\StudentController::class, 'destroy'])
        ->name('users.accepteds.students.remove');
    Route::get('user/students/edit/{student}', [App\Http\Controllers\User\Accepteds\StudentController::class, 'edit'])
        ->name('users.accepteds.students.edit');
    Route::post('user/students/update/{student}', [App\Http\Controllers\User\Accepteds\StudentController::class, 'update'])
        ->name('users.accepteds.students.update');

    //user: accepted: UPLOAD STUDENTS
    Route::get('user/students/upload', [App\Http\Controllers\User\Accepteds\StudentController::class, 'createUpload'])
        ->name('users.accepteds.students.upload');
    Route::post('user/students/store_upload', [App\Http\Controllers\User\Accepteds\StudentController::class, 'storeUpload'])
        ->name('users.accepteds.students.store_upload');

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
