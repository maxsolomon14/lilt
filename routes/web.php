<?php

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

Route::get('/', 'PagesController@index');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/posts', 'PostController@index');
    Route::get('/create', 'PostController@create');
    Route::post('/create-message', 'MessagesController@create_new');
    Route::get('/post/{post}', 'PostController@show');
    Route::get('/profile/{user}', 'PagesController@profile')->name('profile');
    Route::get('/logout', 'Auth\LoginController@logout');
    //Route::get('/login', "PagesController@login");
    Route::post('/store', 'PostController@store');
    Route::post('/search', 'PagesController@search');
    Route::post('/comment/{id}', 'CommentController@AddComment')->name('comment');
    Route::resource('post', 'PostController');
    Route::get('/profiles', 'PagesController@profiles');
    Route::get('/edit/{post}', 'PostController@edit')->name('edit_post');
    Route::get('/delete/{post}', 'PostController@destroy')->name('delete_post');
    Route::get('/delete-image/{post}', 'PostController@delete_image');
    Route::get('/unlike/{id}/{post}', 'LikeController@destroy');
    Route::get('/image', 'PagesController@image');
    Route::post('/image/{post}', 'PostController@image_up')->name('image_up');
    Route::post('/profile-pic/{user}', 'PagesController@image_up')->name('profile-pic');
    Route::get('/like/{post_id}/{user_id}', 'LikeController@index');
    Route::get('/like-save/{post_id}/{user_id}', 'LikeController@create');
    Route::get('/messages', 'MessagesController@index');
    Route::get('/delete-message/{message}', 'MessagesController@destroy');
    Route::get('/inbox/{sender_id}/{recipient_id}', 'MessagesController@show')->name('inbox');
    Route::post('/send/{sender_id}/{recipient_id}', 'MessagesController@store')->name('send');
    Route::post('/update/{post}', 'PostController@update')->name('update-post');
});
