<?php

App::missing(function() {
    return View::make('Errors.denied');
});
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
Route::group(array('prefix' => 'leads/car-type', 'before' => 'auth|hasMod'), function() {
    setRouter();
});
Route::group(array('prefix' => 'contacts/car-type', 'before' => 'auth|hasMod'), function() {
    setRouter();
});

function setRouter() {
    if (Session::has('insert')) {
        Route::get('new/{id_leads}', function($id_leads) {
            return View::make('CarType.new')->with('id_leads', $id_leads);
        });
        Route::post('save', 'CarTypeController@save');
    }
    if (Session::has('update')) {
        Route::get('edit/{id_leads}', function($id_leads) {
            return View::make('CarType.edit')->with('id_leads', $id_leads);
        });
        Route::post('edit-save', 'CarTypeController@edit_save');
    }
    if (Session::has('delete')) {
        Route::post('delete/{id}', 'CarTypeController@delete');
    }
}

Route::group(array('prefix' => 'leads', 'before' => 'auth|hasMod'), function() {
    if (Session::has('insert')) {
        Route::get('new', function() {
            return View::make('Leads.new')->with('mod', 'leads');
        });
        Route::post('new/save', 'LeadsController@save');
    }
    if (Session::has('update')) {
        Route::get('edit/{id}', function($id) {
            return View::make('Leads.edit')->with('id', $id)->with('mod', 'leads');
        });
        Route::post('edit-save/{id}', 'LeadsController@edit_save');
    }
    if (Session::has('list')) {
        Route::get('list', function() {
            return View::make('Leads.list')->with('mod', 'leads');
        });
    }

    if (Session::has('delete')) {
        Route::post('delete/{id}', 'LeadsController@delete');
    }
});

Route::group(array('prefix' => 'contacts', 'before' => 'auth|hasMod'), function() {
    if (Session::has('insert')) {
        Route::get('new', function() {
            return View::make('Contacts.new')->with('mod', 'contacts');
        });
        Route::post('new/save', 'ContactsController@save');
    }
    if (Session::has('update')) {
        Route::get('edit/{id_leads}', function($id_leads) {
            return View::make('Contacts.edit')->with('id_leads', $id_leads)->with('mod', 'contacts');
        });
        Route::post('edit-save/{id}', 'ContactsController@edit_save');
    }
    if (Session::has('list')) {
        Route::get('list', function() {
            return View::make('Contacts.list')->with('mod', 'contacts');
        });
    }
});
Route::group(array('prefix' => 'system', 'before' => 'auth|hasMod'), function() {
    /*     * *****employee********* */

    if (Session::has('insert')) {
        Route::get('employee/new', function() {
            return View::make('Employee.new')->with('mod', 'system');
        });
        Route::get('type-user/new', function() {
            return View::make('TypeUser.new')->with('mod', 'system');
        });
        Route::get('user/new', function() {
            return View::make('User.new')->with('mod', 'system');
        });
    }
    if (Session::has('update')) {
        Route::get('employee/edit/{id}', function($id) {
            return View::make('Employee.edit')->with('id', $id)->with('mod', 'system');
        });
        Route::post('employee/edit-save/{id}', 'EmployeeController@edit_save');
        Route::get('type-user/edit/{id}', function($id) {
            return View::make('TypeUser.edit')->with('id', $id)->with('mod', 'system');
        });
        Route::post('type-user/edit-save/{id}', 'TypeUserController@edit_save');
        Route::get('user/edit/{id}', function($id) {
            return View::make('User.edit')->with('id', $id)->with('mod', 'system');
        });
        Route::post('user/edit-save/{id}', 'UserController@edit_save');
        Route::post('user/save', 'UserController@save');
        Route::post('type-user/save', 'TypeUserController@save');
        Route::post('employee/save', 'EmployeeController@save');
    }
    if (Session::has('list')) {
        Route::get('employee', function() {
            return View::make('Employee.main')->with('mod', 'system');
        });
        Route::get('type-user', function() {
            return View::make('TypeUser.main')->with('mod', 'system');
        });
        Route::get('user', function() {
            return View::make('User.main')->with('mod', 'system');
        });
    }
    if (Session::has('delete')) {
        Route::post('employee/delete/{id}', 'EmployeeController@delete');
        Route::post('type-user/delete/{id}', 'TypeUserController@delete');
        Route::post('user/delete/{id}', 'UserController@delete');
    }
});
