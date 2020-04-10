<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'portal',
    'middleware' => 'portal',
    'namespace' => 'Modules\AfricasTalking\Http\Controllers'
], function () {
    // Route::get('invoices/{invoice}/africas-talking', 'Main@show')->name('portal.invoices.africas-talking.show');
    // Route::post('invoices/{invoice}/africas-talking/confirm', 'Main@confirm')->name('portal.invoices.africas-talking.confirm');
});
