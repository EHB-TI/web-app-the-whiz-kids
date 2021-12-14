<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QuestionCategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Log;

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


//////////////////
// Viewer Event //
//////////////////

Route::name('content.')->group(function () {
    // Index Page with events
    Route::get('/', [EventController::class, 'index'])
        ->name('index');

    // Individual events
    Route::get('/event/{id}', [EventController::class, 'event'])
        ->name('event');

    // about page
    Route::get('/about', function () {
        return view('other.about');
    })->name('about');

    Route::resource('contact', ContactController::class)->only([
        'create', 'store'
    ]);

    Route::resource('faq', QuestionCategoryController::class)->only([
        'index'
    ]);

    // Calender page
    Route::get('/calendar', [CalendarController::class, 'calendar'])
        ->name('calendar');
});

// todo group events and users
Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::group(['middleware' => ['auth']], function () {

            ///////////////////////////
            // Self made Auth routes //
            ///////////////////////////

            Route::get('/change_password', [UserController::class, 'change_password'])
                ->name('change-password');

            Route::post('/change_password', [UserController::class, 'change_password_submit'])
                ->name('change-password-submit');

            Route::group(['middleware' => ['first.time']], function () {

                // dashboard for users
                Route::get('/', function () {
                    return view('admin.index');
                })
                    ->name('index');
                
                /////////////
                // PROFILE //
                /////////////
                
                Route::get('/profile', [ProfileController::class, 'profile'])
                    ->name('profile');

                Route::get('/profile/download', [ProfileController::class, 'download'])
                    ->name('profile.download');

                 Route::get('/profile/delete', [ProfileController::class, 'delete'])
                    ->name('profile.delete');
                ///////////
                // EVENT //
                ///////////

                // event list for users
                Route::get('/events', [EventController::class, 'adminEvents'])
                    ->name('events');


                Route::group(['middleware' => ['editor']], function () {
                    // edit event
                    Route::get('/edit/{id}', [EventController::class, 'editLoad'])
                        ->name('edit');

                    // post for edit events
                    Route::post('/edit/{id}', [EventController::class, 'edit']);

                    // post for visibility
                    Route::post('/event/visibility', [EventController::class, 'visibility'])
                        ->name('event.visibility');


                    // create events
                    Route::get('/create',  [EventController::class, 'createLoad'])
                        ->name('create');

                    // post for create events
                    Route::post('/create', [EventController::class, 'create']);

                    // delete event
                    Route::delete('/delete_event/{id}', [EventController::class, 'delete'])
                        ->name('delete-event');
                });

                Route::group(['middleware' => ['admin']], function () {
                    ///////////
                    // EVENT //
                    ///////////

                    // post for groups
                    Route::post('/event/groups', [EventController::class, 'groups'])
                        ->name('event.groups');

                    //////////
                    // USER //
                    //////////

                    // users
                    Route::get('/users', [UserController::class, 'users'])
                        ->name('users');

                    // add user 
                    Route::get('/add_user', [UserController::class, 'add_user_load'])
                        ->name('add-user');

                    // post for add user 
                    Route::post('/add_user', [UserController::class, 'add_user'])
                        ->name('add-user-submit');

                    // delete user
                    Route::delete('/delete_user/{id}', [UserController::class, 'delete'])
                        ->name('delete-user');

                    // edit user
                    Route::get('/edit_user/{id}', [UserController::class, 'edit_user_load'])
                        ->name('edit-user');

                    // edit user
                    Route::post('/edit_user/{id}', [UserController::class, 'edit_user'])
                        ->name('edit-user-submit');

                    ////////////
                    // GROUPS //
                    ////////////

                    //groups
                    Route::get('/groups', [GroupController::class, 'groups'])
                        ->name('groups');

                    Route::get('/add_groups', [GroupController::class, 'add_group_load'])
                        ->name('add-group');

                    Route::post('/add_groups', [GroupController::class, 'add_group'])
                        ->name('add-group-submit');

                    Route::delete('/delete_group/{id}', [GroupController::class, 'delete_group'])
                        ->name('delete-group');

                    /////////
                    // FAQ //
                    /////////

                    Route::resource('categories', QuestionCategoryController::class)->except([
                        'show'
                    ]);
                    Route::resource('questions', QuestionController::class)->except([
                        'index', 'show', 'create'
                    ]);
                    // changed create route so it can also have category id
                    Route::get('/questions/create/{id}', [QuestionController::class, 'create'])
                        ->name('questions.create');
                });
            });
        });
    });
});

Auth::routes(['register' => false]); // Turn off register
// Auth::routes(); // Turn on register