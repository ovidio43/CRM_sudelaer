<?php

//Event::listen('illuminate.query', function($sql)
//{
//    dd($sql);
//}); 

Route::get('testing', function() {

//    $stringFields = strtolower('CustomerID,"Primary Buyer First Name","Primary Buyer Last Name","Primary Buyer Date of Birth","Primary Buyer Address Line 1","Primary Buyer City","Primary Buyer State/Province","Primary Buyer Postal Code","Primary Buyer Email Address","Primary Buyer Work Phone","Primary Buyer Home Phone","Vehicle Make","Vehicle Model","Vehicle Year","Vehicle VIN/Serial","Vehicle Series","Vehicle Exterior Color","Vehicle Interior Color","Vehicle Number of Cylinders","Vehicle Miles","Vehicle Stock Number","Payment Term","Payment Type (Purchase/Lease)","Sale Price","Trade In 1 Make","Trade In 1 Model","Trade In 1 Year","Trade In 1 VIN/Serial","Trade In 1 Series","Trade In 1 Exterior Color","Trade In 1 Engine Description","Trade In 1 Miles","Trade In 1 Stock Number","Trade In 1 ACV","Vehicle New/Used","Primary Salesperson ID","Deal Date","Deal Number","Current Balance","Total PTD","DMS Quote ID","Secondary Salesperson ID","Bank Name","APR/Finance Rate","Lease Money Factor","Monthly Payment","Lease Monthly Payment","Extended Warranty Price","Extended Warranty Miles","Deal Category (WS/DT/Retail)","Deal Status (Pend/Sold/Clsd)","Primary Buyer Cell Phone","Primary Buyer Address Line 2","Co-Buyer First Name","Co-Buyer Last Name","Co-Buyer Address Line 1","Co-Buyer City","Co-Buyer State/Province","Co-Buyer Postal Code","Co-Buyer Home Phone","FI Back Gross","Commissionable Gross","Vehicle Service Contract Price","Co-Buyer Date of Birth","Trade In 1 Allowance","Trade In 1 Payoff","Trade In 2 Make","Trade In 2 Model","Trade In 2 Series","Trade In 2 Year","Trade In 2 VIN/Serial","Trade In 2 Exterior Color","Trade In 2 Stock Number","Trade In 2 Allowance","Trade In 2 ACV","Trade In 2 Payoff","Transmission Type","Fuel Type","Vehicle Class","Vechile Cost","Rebate","Residual","AH Insurance Premium","AH Insurance Reserve","Sales Manager ID","Finance Manager ID","Total Aftermarket Price","Total Aftermarket Reserve","Gap","Gap Reserve","Finance Reserve","Down Payment","Holdback","Life Insurance Premium","Life Insurance Reserve","Top/Sales Gross","VSC Reserve","House Gross","Pack","Service Maintenance Miles","Service Maintenance Term","Service Maintenance Plan","Delivery Date","Reversal Date","Status Date","Commissionable Cost","Extended Warranty Reserve","GL Balance","List Price","MSRP","Net Cap Cost","Total Amount Financed","Aftermarket Incentive","Co-buyer Email Address","Co-buyer Middle Name","Co-buyer Mobile Phone","Country","Engine Size","Inventive","Primary Buyer Middle Name","Trade In 2 Miles","Trade In Net Trade Amount","Trade In 2 Net Trade Amount","Trim","Mailing Address First Name","Street Address Line 3","Estimated Delivery Date","Ext Warranty Contract Number","Ext Warranty Exp Date","Veh Service Contract Number","Veh Service Contract Exp Date","Additional Note 1","Inventory Company","Additional Fee 1","Additional Fee 2","Additional Fee 3","Additional Fee 4","Additional Fee 5","Additional Fee 6","Additional Fee 7","Additional Fee 8","Additional Fee 9","Additional Fee 10","Addition to Cap Cost 1","Addition to Cap Cost 2","Addition to Cap Cost 3","Addition to Cap Cost 4","Addition to Cap Cost 5","Addition to Cap Cost 6","Addition to Cap Cost 7","Annual Fee 1","Annual Fee 2","Annual Fee 3","Annual Fee 4","Annual Fee 5","Initial Fee 1","Initial Fee 2","Initial Fee 3","Initial Fee 4","Initial Fee 5","Initial Fee 6","Initial Fee 7","Initial Fee 8","Initial Fee 9","Initial Fee 10","License Plate"');
//    $charToReplace = ['(', ')', '-', '/', ' '];
//    $fields = str_replace('"', '`', $stringFields); //reemplazandno doble comilla por nada
//    $fields = str_replace($charToReplace, '_', $fields); //reemplazandno caqracteres por guiens bajo "_"
//
//
//    /*     * ******generador de tabla a partir de array de campos************* */
//
//    'UPDATE tabla SET campo = REPLACE(campo, "-", ""); '; //reeemplazando el - por nada
//    'UPDATE tabla SET campo = REPLACE(campo, " ", ""); '; //reeemplazando el espacio por nada
//    'UPDATE table1 t1 INNER JOIN table2 t2 ON (t1.id = t2.id) SET t1.field_3 = t2.field_3 '; //actualizandos datos de tabla1 a tabla2
//    'SELECT t2.* FROM table2 t2 where t2.id not in (select id from table1)'; //seleccionado fila de table2 q no esta en table1
});


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
    /*     * ***rutas para verificar datos reales************ */
    Route::get('real-email-validation/{email}', function($email) {
        return View::make('Validations.emailVerify.emailVerify')->with('email', $email);
    });
    Route::get('real-phone-validation/{phone}', function($phone) {
        return View::make('Validations.openCnam.reversePhone')->with('phone', $phone);
    });
    /*     * *********************************************** */
    Route::get('my-profile', function() {
        return View::make('User.profile');
    });
    /*     * *****ruta para traer form sms envio********** */
    Route::get('sms-form/{id_leads}/{mobile}', function($id_leads, $mobile) {
        return View::make('Leads.smsform')->with('mobile', $mobile)->with('id_leads', $id_leads);
    });

    /*     * **********ruta para envio de sms*************** */
    Route::post('send-sms', 'LeadsController@sendSMS');
    /*     * **********ruta para envio de Notificacion a usuarios *************** */
    Route::post('notification-save', 'NotificationController@save');
    /*     * ************************* */
    Route::post('edit-profile/{id}', 'UserController@editMyProfile');
    /*     * **********************viste single de las notificaciones************************* */
    Route::get('single/{id_notification}', function($id_notification) {
        return View::make('Dashboard.single')->with('id_notification', $id_notification);
    });
    Route::post('send-trash', 'NotificationController@sendTrash');
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
        /*         * **consulta si numero de telefon existe**** */

        /*         * ****** */
    }
    if (Session::has('update')) {
        Route::get('edit/{id}', function($id) {
            return View::make('Leads.edit')->with('id', $id)->with('mod', 'leads');
        });
        Route::post('edit-save/{id}', 'LeadsController@edit_save');
        Route::post('end-visit', 'LogsController@EdnVisit');
        Route::post('memo-edit/{id}', 'LeadsController@edit_memo');
    }
    if (Session::has('list')) {
        Route::get('find', function() use($mod) {
            return View::make('Leads.search')->with('s', Input::get('s'))->with('filter', Input::get('filter'))->with('mod', $mod);
        });
        Route::get('list', function() use($mod) {
            return View::make('Leads.list')->with('mod', $mod);
        });
        Route::get('mylist', function() {
            return View::make('Leads.mylist')->with('mod', 'leads');
        });
        Route::get('allactivelist', function() use($mod) {
            return View::make('Leads.allactivelist')->with('mod', $mod);
        });
        Route::get('myassignmentslist', function() {
            return View::make('Leads.myassignmentslist')->with('mod', 'leads');
        });
        Route::get('hotlist', function() use($mod) {
            return View::make('Leads.hotlist')->with('mod', $mod);
        });
        Route::get('verify-mobile-number/{mobile}/{id_leads}', function($mobile, $id_leads) use($mod) {
            return View::make('Leads.mobilelist')->with('mobile', $mobile)->with('id_leads', $id_leads)->with('mod', $mod);
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
        Route::get('ambiguous-list', function() {
            return View::make('Contacts.ambiguouslist')->with('mod', 'contacts');
        });
        Route::get('contact-detail/{id}', function($id) {
            return View::make('Contacts.detail')->with('mod', 'contacts')->with('id', $id);
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

