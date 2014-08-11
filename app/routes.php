<?php
//Event::listen('illuminate.query', function($sql)
//{
//    dd($sql);
//}); 
App::missing(function() {
    Session::put('uri_src', Request::url());
    return Redirect::guest('login');
//    return View::make('Errors.denied');
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
    $mod = 'leads';
    if (Session::has('insert')) {
        Route::get('new', function() use($mod) {
            return View::make('Leads.new')->with('mod', 'leads');
        });
        Route::post('new/save', 'LeadsController@save');
        Route::post('logs-activity/save', 'ActivityLogsController@save');
    }
    if (Session::has('update')) {
        Route::get('edit/{id}', function($id) {
            return View::make('Leads.edit')->with('id', $id)->with('mod', 'leads');
        });
        Route::post('edit-save/{id}', 'LeadsController@edit_save');
        Route::post('end-visit', 'LogsController@EdnVisit');
    }
    if (Session::has('list')) {
        Route::get('search', function() use($mod) {
            return View::make('Leads.search')->with('s', Input::get('s'))->with('mod', $mod);
        });
        Route::get('list', function() use($mod) {
            return View::make('Leads.list')->with('mod', $mod);
        });
        Route::get('mylist', function() {
            return View::make('Leads.mylist')->with('mod', 'leads');
        });
        Route::get('myassignmentslist', function() {
            return View::make('Leads.myassignmentslist')->with('mod', 'leads');
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
    $mod = 'system';
    if (Session::has('insert')) {
        Route::get('employee/new', function() use ($mod) {
            return View::make('Employee.new')->with('mod', $mod);
        });
        Route::get('type-user/new', function() use ($mod) {
            return View::make('TypeUser.new')->with('mod', $mod);
        });
        Route::get('user/new', function() use ($mod) {
            return View::make('User.new')->with('mod', $mod);
        });

        Route::get('alert/templates/new', function() use ($mod) {
            return View::make('Templates.new')->with('mod', $mod);
        });


        Route::post('user/save', 'UserController@save');
        Route::post('type-user/save', 'TypeUserController@save');
        Route::post('employee/save', 'EmployeeController@save');
        Route::post('alert/save', 'AlertTypeUserController@save');
        Route::post('alert/templates/save', 'TemplatesController@save');
    }
    if (Session::has('update')) {
        Route::get('employee/edit/{id}', function($id) use($mod) {
            return View::make('Employee.edit')->with('id', $id)->with('mod', $mod);
        });
        Route::get('type-user/edit/{id}', function($id) use($mod) {
            return View::make('TypeUser.edit')->with('id', $id)->with('mod', $mod);
        });
        Route::get('user/edit/{id}', function($id) use($mod) {
            return View::make('User.edit')->with('id', $id)->with('mod', $mod);
        });
        Route::get('alert/edit/{id}', function($id) use($mod) {
            return View::make('Alert.edit')->with('id', $id)->with('mod', $mod);
        });
        Route::get('alert/templates/edit/{id}', function($id) use($mod) {
            return View::make('Templates.edit')->with('id', $id)->with('mod', $mod);
        });
        Route::post('employee/edit-save/{id}', 'EmployeeController@edit_save');
        Route::post('user/edit-save/{id}', 'UserController@edit_save');
        Route::post('type-user/edit-save/{id}', 'TypeUserController@edit_save');
        Route::post('alert/templates/save-edit/{id}', 'TemplatesController@edit_save');
        Route::post('alert/save-edit/{id}', 'AlertController@edit_save');
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
        Route::get('alert', function() {
            return View::make('Alert.main')->with('mod', 'system');
        });
    }
    if (Session::has('delete')) {
        Route::post('employee/delete/{id}', 'EmployeeController@delete');
        Route::post('type-user/delete/{id}', 'TypeUserController@delete');
        Route::post('user/delete/{id}', 'UserController@delete');
    }
});
