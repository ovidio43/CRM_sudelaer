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
Route::group(array('prefix' => 'car-type', 'before' => 'auth'), function() {
    Route::get('new/{id_leadas}', function($id_leads) {
        return View::make('CarType.new')->with('id_leads', $id_leads);
    });
    Route::get('edit/{id_leads}', function($id_leads) {
        return View::make('CarType.edit')->with('id_leads', $id_leads);
    });
    Route::post('save', 'CarTypeController@save');
    Route::post('edit-save', 'CarTypeController@edit_save');
    Route::post('delete/{id}', 'CarTypeController@delete');
});
Route::group(array('prefix' => 'leads', 'before' => 'auth'), function() {
    Route::get('new', function() {
        return View::make('Leads.new');
    });
    Route::get('list', function() {
        return View::make('Leads.list');
    });
    Route::get('edit/{id}', function($id) {
        return View::make('Leads.edit')->with('id', $id);
    });
    Route::post('new/save', 'LeadsController@save');
    Route::post('edit-save/{id}', 'LeadsController@edit_save');
    Route::post('delete/{id}', 'LeadsController@delete');
});

Route::group(array('prefix' => 'contacts', 'before' => 'auth'), function() {
    Route::get('new', function() {
        return View::make('Contacts.new');
    });
    Route::get('edit/{id_leads}', function($id_leads) {
        return View::make('Contacts.edit')->with('id_leads', $id_leads);;
    });
    Route::get('list', function() {
        return View::make('Contacts.list');
    });
    Route::post('new/save', 'ContactsController@save');
});
Route::group(array('prefix' => 'system', 'before' => 'auth'), function() {
    /*     * *****employee********* */
    Route::get('employee', function() {
        return View::make('Employee.main');
    });
    Route::get('employee/new', function() {
        return View::make('Employee.new');
    });
    Route::get('employee/edit/{id}', function($id) {
        return View::make('Employee.edit')->with('id', $id);
    });
    Route::post('employee/save', 'EmployeeController@save');
    Route::post('employee/edit-save/{id}', 'EmployeeController@edit_save');
    Route::post('employee/delete/{id}', 'EmployeeController@delete');

    /*     * *****type user********* */
    Route::get('type-user', function() {
        return View::make('TypeUser.main');
    });
    Route::get('type-user/new', function() {
        return View::make('TypeUser.new');
    });
    Route::get('type-user/edit/{id}', function($id) {
        return View::make('TypeUser.edit')->with('id', $id);
    });
    Route::post('type-user/save', 'TypeUserController@save');
    Route::post('type-user/edit-save/{id}', 'TypeUserController@edit_save');
    Route::post('type-user/delete/{id}', 'TypeUserController@delete');

    /*     * *****user********* */
    Route::get('user', function() {
        return View::make('User.main');
    });
    Route::get('user/new', function() {
        return View::make('User.new');
    });
    Route::post('user/save', 'UserController@save');

    Route::get('user/edit/{id}', function($id) {
        return View::make('User.edit')->with('id', $id);
    });
    Route::post('user/edit-save/{id}', 'UserController@edit_save');
    Route::post('user/delete/{id}', 'UserController@delete');
});
