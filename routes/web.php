<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
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


Route::middleware(['auth'])->group(function () {


    Route::get('/groups', [App\Http\Controllers\GroupController::class, 'index'])->name('groups.index');
    Route::get('/groups/create', [App\Http\Controllers\GroupController::class, 'create'])->name('groups.create');
    Route::post('/groups', [App\Http\Controllers\GroupController::class, 'store'])->name('groups.store');
    Route::get('/groups/{groups}', [App\Http\Controllers\GroupController::class, 'show'])->name('groups.show');
    Route::get('/groups/{groups}/edit', [App\Http\Controllers\GroupController::class, 'edit'])->name('groups.edit');
    Route::put('/groups/{groups}', [App\Http\Controllers\GroupController::class, 'update'])->name('groups.update');
    Route::delete('/groups/{groups}', [App\Http\Controllers\GroupController::class, 'destroy'])->name('groups.destroy');

    Route::post('/groups/{groups}/join', [App\Http\Controllers\GroupUserController::class, 'join'])->name('groups.join');
    Route::post('/groups/{groups}/leave', [App\Http\Controllers\GroupUserController::class, 'leave'])->name('groups.leave');

    Route::post('/groups/{groups}/status', [App\Http\Controllers\GroupStatusController::class, 'store'])->name('groups.status.store');
    Route::get('/groups/{groups}/status/{status}/edit', [App\Http\Controllers\GroupStatusController::class, 'edit'])->name('groups.status.edit');
    Route::put('/groups/{groups}/status/{status}', [App\Http\Controllers\GroupStatusController::class, 'update'])->name('groups.status.update');
    Route::delete('/groups/{groups}/status/{status}', [App\Http\Controllers\GroupStatusController::class, 'destroy'])->name('groups.status.destroy');

});
