<?php

use Illuminate\Support\Facades\Route;

Route::admin(
    'africas-talking',
    function () {
        // Send
        Route::get('/send', 'Send')->name('send.index');
        Route::post('/send', 'Send@handle')->name('send');
        Route::post('/send/customer', 'Send@toCustomer')->name('send.customer');

        // Logs
        Route::get('/logs', 'Log')->name('logs');
        Route::get('/logs/{log}/status', 'Log@checkStatus')->name('logs.checkStatus');
    }
);
