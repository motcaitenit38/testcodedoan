<?php

Route::group(['namespace'=>'Tuyendung'], function() {

    Route::get('/', 'HomeController@index')->name('tuyendung.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('tuyendung.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('tuyendung.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('tuyendung.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('tuyendung.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('tuyendung.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('tuyendung.password.reset');

});