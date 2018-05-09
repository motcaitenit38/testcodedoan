<?php

Route::group(['namespace'=>'Timviec'], function() {

    Route::get('/', 'HomeController@index')->name('timviec.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('timviec.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('timviec.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('timviec.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('timviec.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('timviec.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('timviec.password.reset');

    Route::get('test', function () {
        return "acb";
    })->middleware('tuyendung.auth:tuyendung');

});