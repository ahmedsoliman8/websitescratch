<?php



Route::get('/GetAllVideos','HomeController@GetAllVideos');



Route::namespace('BackEnd')->prefix('admin')->middleware('admin')->group(function (){
    Route::get('home','Home@index')->name('admin.home');
    Route::resource("users","Users")->except(["show"]);
    Route::resource("categories","Categories")->except(["show"]);
    Route::resource("skills","Skills")->except(["show"]);
    Route::resource("tags","Tags")->except(["show"]);
    Route::resource("pages","Pages")->except(["show"]);
    Route::resource("videos","Videos")->except(["show"]);
    Route::post("comments","Videos@commentStore")->name('comments.store');
    Route::get("comments/{id}","Videos@commentDelete")->name('comments.delete');
    Route::post("comments/{id}","Videos@commentUpdate")->name('comments.update');
    Route::resource("messages","Messages")->only(["index","edit","destroy"]);

    Route::post("messages/replay/{id}","Messages@replay")->name('message.replay');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('category/{id}', 'HomeController@category')->name('front.category');
Route::get('skill/{id}', 'HomeController@skill')->name('front.skill');
Route::get('tag/{id}', 'HomeController@tag')->name('front.tag');
Route::get('video/{id}', 'HomeController@video')->name('frontend.video');
Route::get('page/{id}/{slug?}', 'HomeController@page')->name('front.page');

Route::get('profile/{id}/{slug?}', 'HomeController@profile')->name('front.profile');

Route::get('/','HomeController@welcome')->name('frontend.landing');
Route::middleware('auth')->group(function (){
Route::post('comments/{id}', 'HomeController@commentUpdate')->name('front.commentUpdate');
Route::post('comments/{id}/create', 'HomeController@commentStore')->name('front.commentStore');

Route::post('profile', 'HomeController@profileUpdate')->name('profile.update');

});


Route::get('contact-us', 'HomeController@messageStore')->name('contact.store');




















