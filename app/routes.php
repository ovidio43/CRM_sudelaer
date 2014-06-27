<?php

Route::get('/', function() {
    return View::make('Login.main');
});
Route::get('login', function() {
    return View::make('Login.main');
});
Route::post('singin', 'UserController@doLogin');
Route::get('logout', 'UserController@logOut');
Route::group(array('before' => 'auth'), function() {
    Route::get('dashboard', function() {
        return View::make('Dashboard.main');
    });
    Route::get('migrate-to-contacts/{id_leads}', 'LeadsController@migrate_to_contact');
});
Route::group(array('prefix' => 'leads', 'before' => 'auth'), function() {
    Route::get('new', function() {
        return View::make('Leads.new');
    });
    Route::get('list', function() {
        return View::make('Leads.list');
    });
    Route::post('new/save', 'LeadsController@save');
});
Route::group(array('prefix' => 'contacts', 'before' => 'auth'), function() {
    Route::get('new', function() {
        return View::make('Contacts.new');
    });
    Route::get('list', function() {
        return View::make('Contacts.list');
    });
    Route::post('new/save', 'ContactsController@save');
});
