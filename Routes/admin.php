<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'admin',
    'namespace' => 'Modules\AfricasTalking\Http\Controllers'
], function () {
    Route::prefix('africas-talking')->group(function() {
        // Route::get('/', 'Main@index');
    });
});
