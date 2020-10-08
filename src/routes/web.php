<?php


Route::group(['namespace' => 'duncanrmorris\invoicemodule\Http\Controllers'], function()
{
    Route::group(['middleware' => ['web', 'auth']], function(){

    #### INVOICES MODUEL ####
	Route::get('invoices', 'InvoicesController@index')->name('invoices');
	Route::get('invoices/new', 'InvoicesController@create')->name('invoices.new');
	Route::get('invoices/edit/{id}', 'InvoicesController@edit')->name('invoices.edit');
	Route::put('invoices/update/{id}', 'InvoicesController@update')->name('invoices.update');
	Route::get('invoices/view/{id}', 'InvoicesController@show')->name('invoices.view');
	Route::put('invoices/crm-del/{id}', 'InvoicesController@destroy')->name('invoices.del');
	Route::get('invoices/download/{id}','InvoicesController@downloadPDF')->name('invoices.download');
	### INVOICE LINES ###
	Route::put('invoices/ln-update/{id}/{iid}', 'InvoicesLinesController@update')->name('invoices.ln.update');
	Route::get('invoices/ln-net/{id}', 'InvoicesLinesController@create')->name('invoices.ln.new');

    });
});