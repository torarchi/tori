<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\GroupStatusesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a groups which
| contains the "web" middleware groups. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/alert', function (){
    return redirect()->route('home')->with('info', 'Вы успешно вошли');
});

Route::get('/sign-up', [\App\Http\Controllers\AuthController::class, 'getSignUp'])->name('signup')->middleware(['guest']);
Route::post('/sign-up', [\App\Http\Controllers\AuthController::class, 'postSignUp'])->middleware(['guest']);

Route::get('/sign-in', [\App\Http\Controllers\AuthController::class, 'getSignIn'])->name('signin')->middleware(['guest']);
Route::post('/sign-in', [\App\Http\Controllers\AuthController::class, 'postSignIn'])->middleware(['guest']);

Route::get('/sign-out', [\App\Http\Controllers\AuthController::class, 'getSignOut'])->name('signout');

Route::get('/search', [\App\Http\Controllers\SearchController::class, 'getResults'])->name('search-results');

Route::get('/user/{username}', [\App\Http\Controllers\ProfileController::class, 'getProfile'])->name('profile.index');

Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'getEdit'])->name('profile.edit')->middleware(['auth']);
Route::post('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'postEdit'])->middleware(['auth']);;

Route::get('/friends', [\App\Http\Controllers\FriendController::class, 'getIndex'])->name('friend.index')->middleware(['auth']);
Route::get('/friends/add/{username}', [\App\Http\Controllers\FriendController::class, 'getAdd'])->name('friend.add')->middleware(['auth']);
Route::post('/friends/delete/{username}', [\App\Http\Controllers\FriendController::class, 'postDelete'])->name('friend.delete')->middleware(['auth']);
Route::get('/friends/accept/{username}', [\App\Http\Controllers\FriendController::class, 'getAccept'])->name('friend.accept')->middleware(['auth']);

Route::post('/status', [\App\Http\Controllers\StatusController::class, 'postStatus'])->name('status.post')->middleware(['auth']);
Route::post('/status/delete/{id}', [\App\Http\Controllers\StatusController::class, 'removeStatus'])->name('status.remove')->middleware(['auth']);

Route::get('/groups', [\App\Http\Controllers\GroupsController::class, 'index'])->name('groups.index')->middleware(['auth']);
Route::get('/groups/create', [\App\Http\Controllers\GroupsController::class, 'create'])->name('groups.create')->middleware(['auth']);
Route::post('/groups', [\App\Http\Controllers\GroupsController::class, 'store'])->name('groups.store')->middleware(['auth']);
Route::post('/groups/{group}/statuses', [\App\Http\Controllers\GroupsController::class, 'stores'])->name('group_statuses.stores')->middleware(['auth']);
Route::get('/groups/{group}', [\App\Http\Controllers\GroupsController::class, 'show'])->name('groups.show')->middleware(['auth']);
Route::put('/groups/{group}', [\App\Http\Controllers\GroupsController::class, 'update'])->name('groups.update')->middleware(['auth']);
Route::delete('/groups/{group}', [\App\Http\Controllers\GroupsController::class, 'destroy'])->name('groups.destroy')->middleware(['auth']);

Route::post('groups/{group}/join', [\App\Http\Controllers\GroupsController::class, 'join'])->name('groups.join')->middleware(['auth']);
Route::delete('groups/{group}/leave', [\App\Http\Controllers\GroupsController::class, 'leave'])->name('groups.leave')->middleware(['auth']);


