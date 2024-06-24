<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

//GATE
Route::get('/admins-only', function(){
    return "only admin is allowed to view this page";
})->middleware('can:visitAdminPages');

//user Related Routes 
Route::get('/', [UserController::class, "showCorrectHomepage"]);
Route::post('/register', [UserController::class, "register"]);
Route::post('/login', [UserController::class, "login"]); 
Route::post('/logout', [UserController::class, "logout"]); 
Route::get('/manageAvatar', [UserController::class, "showAvatarForm"])->middleware('customAuth');
Route::post('/updateAvatar', [UserController::class, "updateAvatar"])->middleware('customAuth');

//Blog post Related routes
Route:: get('/createPost', [PostController::class, "showCreateForm"])->middleware('customAuth');
Route:: post('/createPost', [PostController::class, "createPost"])->middleware('customAuth');;
Route:: get('/post/{post}', [PostController::class, "viewSinglePost"]);
Route:: delete('/delete/{post}', [PostController::class, "deletePost"])->middleware('can:delete,post');//From route a authenticated user can delete post
Route:: get('/editPost/{post}', [PostController::class, "viewEditForm"])->middleware('can:update,post');
Route:: put('/updatePost/{post}', [PostController::class, "updatePost"])->middleware('can:update,post');
//getting by id is the default
//Profile Routes
Route:: get('/profile/{post:name}', [UserController::class, "profile"])->middleware('customAuth');
//getting by name