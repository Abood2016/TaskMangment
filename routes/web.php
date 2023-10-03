<?php

use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\Front\indexController;
use App\Http\Controllers\admin\UserController;
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


Route::group(['namespace' => 'Front'], function () {
    Route::get('/', [
        indexController::class, 'index'
    ])->name('home.index');
});


Route::group(
    ['prefix' => 'dashboard', 'namespace' => 'admin'],
    function () {
        Route::group(['middleware' => ['auth:web']], function () {
            Route::get('/', [dashboardController::class, 'index'])->name('dashboard.index');
            //category routes
            Route::group(['prefix' => 'categories'], function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('categories');
                Route::post('/AjaxDT', [CategoriesController::class, 'AjaxDT']);
                Route::get('/create', [CategoriesController::class, 'create'])->name('categories.create');
                Route::post('/store', [CategoriesController::class, 'store'])->name('categories.store');
                Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
                Route::put('/update/{id}', [CategoriesController::class, 'update'])->name('categories.update');
                Route::get('/delete/{id}', [CategoriesController::class, 'delete'])->name('categories.delete');
                Route::get('/show/{id}', [CategoriesController::class, 'show'])->name('categories.show');
            });
            //user routes
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [UserController::class, 'index'])->name('users');
                Route::post('/AjaxDT', [UserController::class, 'AjaxDT']);
                Route::get('/create', [UserController::class, 'create'])->name('users.create');
                Route::post('/store', [UserController::class, 'store'])->name('users.store');
                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
                Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
                Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
                Route::get('/activate/{id}', [UserController::class, 'activate']);

            });

            //project routes
            Route::group(['prefix' => 'projects'], function () {
                Route::get('/', [ProjectController::class, 'index'])->name('projects');
                Route::post('/AjaxDT', [ProjectController::class, 'AjaxDT']);
                Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
                Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');
                Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
                Route::put('/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
                Route::get('/delete/{id}', [ProjectController::class, 'delete'])->name('projects.delete');
            });

            //orders/conracts routes
            Route::group(['prefix' => 'contacts'], function () {
                Route::get('/', [ContactController::class, 'index'])->name('contacts');
                Route::post('/AjaxDT', [ContactController::class, 'AjaxDT']);
                Route::get('/create', [ContactController::class, 'create'])->name('contacts.create');
                Route::post('/store', [ContactController::class, 'store'])->name('contacts.store');
                Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('contacts.edit');
                Route::put('/update/{id}', [ContactController::class, 'update'])->name('contacts.update');
                Route::get('/delete/{id}', [ContactController::class, 'delete'])->name('contacts.delete');
                Route::get('/activate/{id}', [ContactController::class, 'activate']);
                Route::get('/my-contacts', [ContactController::class, 'myContactIndex'])->name('myContact.show')->middleware('IsEmployee');
                Route::post('/my-contacts-AjaxDT', [ContactController::class, 'myContact'])->middleware('IsEmployee');
                Route::get('/edit-myContact/{id}', [ContactController::class, 'editContact'])->name('mycontacts.edit');
                Route::put('/updatemyContact/{id}', [ContactController::class, 'updateContact'])->name('mycontacts.update');
            });

            //tasks routes
            Route::group(['prefix' => 'tasks'], function () {
                Route::get('/', [TaskController::class, 'index'])->name('tasks');
                Route::post('/AjaxDT', [TaskController::class, 'AjaxDT']);
                Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
                Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
                Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
                Route::put('/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
                Route::get('/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
                Route::get('/activate/{id}', [TaskController::class, 'activate']);
                Route::get('/comlpeted-tasks', [TaskController::class, 'comlpetedTask'])->name('comlpeted.tasks');
                Route::post('/comlpeted-tasks-AjaxDT', [TaskController::class, 'comlpetedTaskAjaxDT']);
                Route::get('/my-tasks', [TaskController::class, 'MyTask'])->name('MyTask');
                Route::post('/my-tasks-AjaxDT', [TaskController::class, 'MyTaskAjaxDT']);
                Route::get('/show/{id}', [TaskController::class, 'showTask'])->name('tasks.show');
                Route::get('/my-comlpeted-tasks', [TaskController::class, 'MycomlpetedTask'])->name('mycomlpeted.tasks');
                Route::get('/category_users/{id}', [TaskController::class, 'category_users']);
                Route::get('/edit-user-task/{id}', [TaskController::class, 'edit_user_task']);
                Route::put('/edit-user-task/update/{id}', [TaskController::class, 'update_user_task'])->name('update_user_task');
                Route::get('/all-tasks', [TaskController::class, 'all_tasks'])->name('all_tasks');
                Route::post('/allTasksAjaxDT', [TaskController::class, 'allTasksAjaxDT']);
            });

            //setting route
            Route::group(['prefix' => 'settings'], function () {
                Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('settings.edit');
                Route::put('/update/{id}', [SettingController::class, 'update'])->name('settings.update');
                // Route::get('/my-tasks', [SettingController::class, 'myTask'])->name('myTask');

            });
        });
    }
);


//profile routes
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/show-profile/{id}', [ProfileController::class, 'profile'])->name('profile.show');
    Route::post('/update_profile',   [ProfileController::class, 'updateProfile'])->name('update.profile');
});

//authentication routes
Route::get('/user-register', [RegisterController::class, 'register'])->name('user.register');
Route::post('/user-store', [RegisterController::class, 'store'])->name('user.store');
Route::get('/user-login', [LoginController::class, 'showLogin'])->name('show.login');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::post('logout', [LoginController::class, 'logout'])->name('user.logout');
