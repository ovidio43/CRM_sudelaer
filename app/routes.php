<?php

Route::get('contacts/new', function() {
    return View::make('Contacts.new');
});
Route::get('contacts/list', function() {
    return View::make('Contacts.list');
});
Route::post('contacts/new/save', 'ContactsController@save');
Route::get('migrate-to-contacts/{id_leads}', 'LeadsController@migrate_to_contact');
Route::get('/', function() {
    return View::make('Login.main');
});
Route::get('dashboard', function() {
    return View::make('Dashboard.main');
});
Route::post('login', 'UserController@doLogin');
Route::get('login/logout', 'UserController@logOut');

Route::group(array('prefix' => 'leads', 'before' => 'auth'), function() {
    Route::get('new', function() {
        return View::make('Leads.new');
    });
    Route::get('list', function() {
        return View::make('Leads.list');
    });
    Route::post('new/save', 'LeadsController@save');
//    Route::get('leads/new', function() {
//        return View::make('Leads.new');
//    });
//    Route::get('leads/list', function() {
//        return View::make('Leads.list');
//    });
//    Route::post('leads/new/save', 'LeadsController@save');
});
