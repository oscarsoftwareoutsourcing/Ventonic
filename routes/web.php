<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('welcome');
});

Route::get('/panel', function () {
    return view('panel');
});

//ruta de prueba
Route::get('/test', function () {
    return view('test');
});

/* Route::get('calender', function () {
    if (auth()->check()) {
        return view('calender');
    }
    return view('welcome');
})->name('events.calender'); */

Route::get('acceso/{type?}', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('acceso', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('registro/{type?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('registro', 'Auth\RegisterController@register');
Route::get('clave/{type}/reiniciar', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('clave/correo', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('clave/reiniciar/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('clave/reiniciar', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('clave/confirmar', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('clave/confirmar', 'Auth\ConfirmPasswordController@confirm');
Route::get('correo/verificar', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('correo/verificar/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('correo/reenviar', 'Auth\VerificationController@resend')->name('verification.resend');


/** Rutas para chat */
Route::get('chat', 'ChatController@index')->name('chat');
Route::post('chat', 'ChatController@peerToPeer');
Route::get('messages', 'ChatController@fetchMessages');
Route::post('messages', 'ChatController@sendMessage');


/** Rutas del backend de la aplicación */
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('storage/files/{file}', function ($file) {
        $path = storage_path('files/' . $file);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });
    Route::get('storage/documents/{file}', function ($file) {
        $path = storage_path('app/documents/' . $file);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });
    Route::get('storage/contacts/{file}', function ($file) {
        $path = storage_path('app/contacts/' . $file);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });
    Route::get('attachment/{file}', function ($file) {
        $path = storage_path('app/attachments/' . $file);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });
    Route::get('inicio', 'HomeController@index')->name('home');
    Route::get('buscar-vendedores', 'HomeController@searchSeller')->name('search.init');
    Route::post('filtro', 'HomeController@filterSearch')->name('filter.search');
    Route::resource('perfil', 'ProfileController');
    //Route::resource('questions', 'QuestionController');
    Route::get('get-users', 'HomeController@getUsers')->name('get-users');
    Route::get('get-surveys', 'HomeController@getSurveys')->name('get-surveys');

    Route::resource('events', 'EventController');
    Route::get('has-calendars', 'EventController@hasExternalCalendars');
    Route::get('ultimos-eventos', 'EventController@lastEvents')->name('events.list');
    Route::post('get-country-flag', 'ProfileController@getCountryFlag')->name('get-country-flag');
    Route::get('contact-seller/{id}', 'ChatController@contactSeller');
    Route::get(
        'contact-by/{user_id}/{type}/{origin_type?}/{origin_id?}',
        'ChatController@contactBy'
    )->name('contact-by');
    Route::get('get-chat-users', 'ChatController@getUserChatRooms');
    Route::get('set-chat-room/{id}/{user_id}', 'ChatController@setChatRoom');
    Route::post('filter-chat-users', 'ChatController@filterUserChatRooms');
    Route::delete('chatroom/{id}/delete', 'ChatController@destroyChatRoom');
    Route::post('notification-time/update', 'NotificationController@updateTime');
    Route::get('mi-cuenta', function () {
        return view('auth.my-account');
    })->name('myaccount');
    Route::get('get-account-data', 'UserController@getAccountData');
    Route::post('update-account', 'UserController@update');

    /** Rutas para la gestión de correos */
    Route::group(['prefix' => 'email'], function () {
        Route::get('/', 'EmailController@index')->name('email');
        Route::get('settings', 'EmailController@getSetting');
        Route::post('settings', 'EmailController@setSetting');
        Route::post('remove-settings', 'EmailController@destroySetting');
        Route::get('messages/{download?}', 'EmailController@getMessages')->name('email.get-messages');
        Route::post('sent', 'EmailController@sentMessage')->name('email.sent-message');
        Route::post('messages/delete', 'EmailController@destroyMessages');
        Route::post('set-favorite', 'EmailController@setFavorite');
        Route::post('save-draft', 'EmailController@saveDraft');
        Route::post('mark-read', 'EmailController@markRead');
        Route::post('upload-attachment', 'EmailController@uploadAttachment');
        Route::post('delete-attachment', 'EmailController@destroyAttachment');
        Route::post('set-tags', 'EmailController@setTags');
        Route::get('get-tagged-messages', 'EmailController@getTaggedMessages');
        Route::post('check-auto-config', 'EmailController@checkAutoConfig');
        Route::post('mark-as', 'EmailController@markMessagesAs');
    });

    /** Rutas para la gestión del sistema */
    Route::group(['prefix' => 'sistema'], function () {
        /** Rutas para la gestión de correos */
        Route::group(['prefix' => 'correo'], function () {
            Route::resource('plantillas', 'EmailTemplateController', [
                'as' => 'app',
                'names' => 'email_templates',
                'except' => ['show']
            ]);
            Route::post('plantillas/get-variables', 'EmailTemplateController@getVariables');
            Route::get('plantillas/get-mailables', 'EmailTemplateController@getMailables');
            Route::get('plantillas/get-modules', 'EmailTemplateController@getModules');
        });
    });

    /** Rutas para la gestión de contactos */
    Route::group(['prefix' => 'contacto'], function () {
        Route::get('listado', 'ContactController@index')->name('contact.list');
        Route::get('crear/{contact?}', 'ContactController@create')->name('contact.create');
        Route::post('save', 'ContactController@store')->name('contact.save');
        Route::get('widget/{contacts?}', 'ContactController@show')->name('contact.show');
        Route::get('image/{filename}', 'ContactController@getImage')->name('contact.image');
        Route::get('eliminar/{contact_id}/{user_id}', 'ContactController@destroy')->name('contact.destroy');
        Route::get('editar/{contact_id}', 'ContactController@edit')->name('contact.editForm');
        Route::post('update', 'ContactController@update')->name('contact.update');
        Route::get('get-contacts/{contact_id?}', 'ContactController@getContacts');
        Route::get('detalles/{contact}', 'ContactController@detail')->name('contact.detail');
        Route::delete('{contact}/delete', 'ContactController@destroyContact');
        Route::post('change-picture', 'ContactController@changePicture');
        Route::post('remove-picture', 'ContactController@removePicture');
        Route::post('simple-save', 'ContactController@simpleStore');
    });

    /** Rutas de componentes generales de la aplicación */
    Route::group(['namespace' => 'Components', 'prefix' => 'components'], function () {
        /**
         * Gestión de correos
         */
        Route::get('get-emails/{class}/{id}', 'EmailAppController@getEmails');
        Route::post('set-email', 'EmailAppController@setEmail');
        Route::post('get-contacts-emails', 'EmailAppController@getContactEmails');

        /**
         * Gestión de notas
         */
        Route::get('get-notes/{class}/{id}', 'NoteController@getNotes');
        Route::post('set-note', 'NoteController@setNote');

        /**
         * Gestión de eventos
         */
        Route::get('get-events/{class}/{id}', 'EventController@getEvents');
        Route::post('set-event', 'EventController@setEvent');

        /**
         * Gestión de archivos
         */
        Route::post('upload-documents', 'FileController@uploadDocument');
        Route::post('set-document', 'FileController@setDocument');
        Route::get('get-documents/{class}/{id}', 'FileController@getDocuments');
        Route::post('delete-document', 'FileController@deleteDocument');

        /**
         * Gestión de llamadas
         */
        Route::get('get-call-results', 'CallResultController@getCallResults');
        Route::get('get-calls/{class}/{id}', 'CallController@getCalls');
        Route::post('set-call', 'CallController@setCall');

        /**
         * Gestión de tareas
         */
        Route::get('get-task-types', 'TaskController@getTaskTypes');
        Route::get('get-task-priorities', 'TaskController@getTaskPriorities');
        Route::get('get-task-queues', 'TaskController@getTaskQueues');
        Route::get('get-tasks/{class}/{id}', 'TaskController@getTasks');
        Route::post('set-task', 'TaskController@setTask');
    });
});

/* Routas para oportunidades */
Route::get('oportunitys', 'OportunyController@index')->name('oportunity.saved')->middleware('verified');
Route::get('list/oportunitys', 'OportunyController@showAll')->name('oportunity.list')->middleware('verified');
Route::get(
    'create/{oportunity?}',
    'OportunyController@showRegistrationOportunity'
)->name('oportunity.form')->middleware('verified');
Route::post('save', 'OportunyController@store')->name('oportunity.save')->middleware('verified');
Route::post('oportunity/update', 'OportunyController@update')->name('oportunity.update')->middleware('verified');
Route::get(
    'oportunity/image/{filename}',
    'OportunyController@getImage'
)->name('oportunityImage')->middleware('verified');
Route::get('oportunity/{id}', 'OportunyController@showOportunity')->name('oportunity')->middleware('verified');
Route::get('oportunity/change-status/{oportunity}/{statusType}', 'OportunyController@changeStatus')
     ->name('oportunity.change_status')->middleware('verified');


/* Rutas para postulaciones */
Route::post('postularme', 'AplicantController@store')->name('oportunity.postulation')->middleware('verified');
Route::get(
    'postulados/{oportunity_id}',
    'AplicantController@myaplicants'
)->name('oportunity.mispostulados')->middleware('verified');
Route::get(
    'profile/aplicant/{id}',
    'AplicantController@profilePostulant'
)->name('oportunity.profile')->middleware('verified');
Route::get(
    'estatus/{id}/{estatus_postulations_id}',
    'AplicantController@updateStatus'
)->name('oportunity.estatusUpdate')->middleware('verified');


/*Notificaciones */
Route::get('markAsRead/{type?}', function ($type = null) {
    if ($type !== null) {
        if ($type === 'chat') {
            auth()->user()->unreadNotifications->where('type', 'App\Notifications\ChatRoom')->markAsRead();
        }
    } else {
        auth()->user()->unreadNotifications->markAsRead();
    }
});

// Route::get('test', function () {
//     event(new App\Events\PostulationOportunity('Someone'));
//     return "Event has been sent!";
// });



// Rutas para grupos

Route::get('grupos/crear', 'GroupController@show')->name('group.show')->middleware('verified');
Route::get('grupos/form', 'GroupController@create')->name('group.form')->middleware('verified');
Route::get('grupos/editar/{group_id}', 'GroupController@edit')->name('group.edit')->middleware('verified');
Route::post('grupos/saved', 'GroupController@store')->name('group.saved')->middleware('verified');
Route::post('grupos/update', 'GroupController@update')->name('group.update')->middleware('verified');
Route::post(
    'grupos/destroy',
    'GroupController@destroy'
)->name('group.destroy')->middleware('verified');

Route::get(
    'grupos/confirmar/{invitacion_id}',
    'GroupController@confirmAceptInvitation'
)->name('group.confirmInvitation')->middleware('verified');
Route::get(
    'aceptar/{id_group}/{invitacion_id}',
    'GroupController@aceptInvitation'
)->name('groups.confirm')->middleware('verified');
Route::get(
    'rechazar/{id_group}/{invitacion_id}',
    'GroupController@cancelInvitation'
)->name('groups.cancel')->middleware('verified');


// EM Modules
Route::group(['middleware' => ['verified']], function () use ($router) {

    // Notes module
    Route::get('todos', 'TodoController@index')->name('todos');

    // Email module
    Route::get('email', 'EmailController@index')->name('email');

    // Negotiations
    // Rutas para negociaciones Company
    Route::get('negociaciones', 'NegotiationController@index')->name('negociaciones');
    Route::get('negotiation/change-status/{negotiation}/{stateId}', 'NegotiationController@changeState');

    // $router->get('negociacion/save/{seller_profile_id}/{status_negociations_id}/{producto}/{responsable}/{estimado}',
    // 'NegociationCompanyController@store')->name('negociationCompany.store')->middleware('verified');
});




/* Routas para reportes */
Route::get('informes/ventas', 'ReportController@sales')->name('report.sales')->middleware('verified');
Route::get('informes/actividad', 'ReportController@activities')->name('report.activities')->middleware('verified');

Route::get('calender', 'EventController@index')->name('events.calender');

Route::get('{uuid}/widget', 'WidgetController@show');

//Route::view('dash', 'inicio-dashboard');

Route::get('call-me', 'FreeAppController@index')->name('freeapps')->middleware('verified');
Route::get('validate-pin/{pin}', 'FreeAppController@validatePin')->name('validatepin');
Route::post('widget/generateWidget', 'WidgetController@store');
Route::get('widget/widgetsData/{id?}', 'WidgetController@widgetsData')->name('widgets.data');
Route::get(
    'updateWidgetStatus/{widgetID}/{widgetStatus}',
    'WidgetController@updateWidgetStatus'
)->name('widgets.update');
Route::get('{uuid}/widget', 'WidgetController@show');

Route::get('apps-gratis', 'FreeAppController@apps')->name('apps')->middleware('verified');

/*Route DashBoard */
Route::post('filterDashbaord', 'HomeController@filterDashbaord')->middleware('verified');

Route::get('dashdemo', 'HomeController@demo')->name('dash.demo')->middleware('verified');
Route::get('mi-dash', 'HomeController@midash')->name('me.dash')->middleware('verified');



Route::group(['middleware' => ['verified'], 'prefix' => 'google-calendar'], function () {
    Route::resource('/', 'GoogleCalendarController');
    Route::get('oauth', 'GoogleCalendarController@oauth')->name('google.oauth');
    Route::get('callback', 'GoogleCalendarController@oauth');
    Route::get('get-calendars', 'GoogleCalendarController@getAllCalendarList');
    Route::post('event/create', 'GoogleCalendarController@store');
    Route::post('event/update', 'GoogleCalendarController@update');
    Route::post('event/delete', 'GoogleCalendarController@destroy');
    Route::get('sync', 'GoogleCalendarController@syncGoogleCalendar')->name('google-calendar-sync');
    Route::post('disconnect', 'GoogleCalendarController@disconnect');
});
