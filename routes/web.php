<?php
// Homepage
Route::get('/', 'HomeController@index')->name('home');
// Post
Route::get('posts','PostController@index')->name('posts.index');
Route::get('post/{slug}','PostController@details')->name('post.details');
//Subscriber
Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');
// Favorite, Comment
Route::group(['middleware' => ['auth']], function () {
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
    Route::post('comment/{post}','CommentController@store')->name('comment.store');
});
// Auth
Auth::routes();

// Admin route group
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    // Dashboard
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    // User Settings
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
    // Tag
    Route::resource('tag', 'TagController');
    // Category
    Route::resource('category', 'CategoryController');
    // Post
    Route::resource('post', 'PostController');
    Route::get('pending/post', 'PostController@pending')->name('post.pending');
    Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');
    // Subscriber
    Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');
    // Favorite
    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');
});
// Author route group
Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function () {
    // Dashboard
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    // Post
    Route::resource('post', 'PostController');
    // User Settings
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
    // Favorite
    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');
});

