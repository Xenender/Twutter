<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;

Route::get('/phpinfo', function () {
    return view('phpinfo');
});



Route::controller(UserController::class)->group(function () {
    Route::get('/', 'showHome')->name('home');
    Route::get('/profil', 'showProfile')->name('profile')->middleware(Authenticate::class);
    Route::get('/settings', 'showSettings')->name('settings')->middleware(Authenticate::class);;
    Route::post('/post', 'sendPost')->name('post')->middleware(Authenticate::class);;
    Route::get('/allUsers', 'allUsers')->middleware(Authenticate::class);;
    Route::post('/createUser', 'create');
    Route::post('/loginUser', 'loginUser');
    Route::post('/send-email', 'sendEmail')->middleware(Authenticate::class);
    Route::get('/getUsernameFromId', 'getUsernameFromId')->middleware(Authenticate::class);



    //

    Route::get('/userhome','showUserHome')->middleware(Authenticate::class);



});


Route::controller(MessageController::class)->group(function () {

    Route::get('/message', 'showMessage')->name('message')->middleware(Authenticate::class);
    Route::get('/search-users', 'search')->middleware(Authenticate::class);
    Route::get('/search-discution', 'search_discu')->middleware(Authenticate::class);
    Route::get('/sendMsg', 'sendMsg')->middleware(Authenticate::class);
    Route::get('/getMsg', 'getMsg')->middleware(Authenticate::class);
    Route::get('/createGroup', 'createGroup')->middleware(Authenticate::class);
    Route::get('/searchGroupsUser','searchGroupsUser')->middleware(Authenticate::class);
    Route::get('/getGroupFromParticipate', 'getGroupFromParticipate')->middleware(Authenticate::class);
});

Route::controller(PDFController::class)->group(function(){

    Route::get('/generate-pdf', 'generatePDF')->middleware(Authenticate::class);

});

Route::controller(PostController::class)->group(function(){

    Route::get('/UserLiked', 'UserLiked')->middleware(Authenticate::class);
    Route::get('/dislikePost', 'dislikePost')->middleware(Authenticate::class);
    Route::get('/likePost', 'likePost')->middleware(Authenticate::class);
    Route::get('/nbLikePost', 'nbLikePost')->middleware(Authenticate::class);
    Route::get('/nbLikePostUser', 'nbLikePostUser')->middleware(Authenticate::class);
    Route::get('/deletePost', 'deletePost')->middleware(Authenticate::class);
    Route::get('/commentPost', 'commentPost')->middleware(Authenticate::class);
    Route::get('/getAllCommentPost', 'getAllCommentPost')->middleware(Authenticate::class);


});