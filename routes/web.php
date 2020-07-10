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
    if (auth()->check() && auth()->user()->type === "E") {
        // return view('search-result');
        //return view('inicio-dashboard');
        return view('dashboard.index');
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

Route::get('/inicio', 'HomeController@index')->name('home')->middleware('verified');
Route::get('buscar-vendedores', 'HomeController@searchSeller')->name('search.init')->middleware('verified');

Route::post('filtro', 'HomeController@filterSearch')->name('filter.search')->middleware('verified');
Route::resource('perfil', 'ProfileController')->middleware('verified');
//Route::resource('questions', 'QuestionController')->middleware('verified');
Route::get('get-users', 'HomeController@getUsers')->name('get-users')->middleware('verified');
Route::get('get-surveys', 'HomeController@getSurveys')->name('get-surveys')->middleware('verified');

/** Rutas para chat */
Route::get('chat', 'ChatController@index')->name('chat');
Route::post('chat', 'ChatController@peerToPeer');
Route::get('messages', 'ChatController@fetchMessages');
Route::post('messages', 'ChatController@sendMessage');

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
    Route::resource('events', 'EventController');
    Route::get('ultimos-eventos', 'EventController@lastEvents')->name('events.list');
    Route::post('get-country-flag', 'ProfileController@getCountryFlag')->name('get-country-flag');
    Route::get('contact-seller/{id}', 'ChatController@contactSeller');
    Route::get('contact-by/{user_id}/{type}/{origin_type?}/{origin_id?}', 'ChatController@contactBy')->name('contact-by');
    Route::get('get-chat-users', 'ChatController@getUserChatRooms');
    Route::get('set-chat-room/{id}/{user_id}', 'ChatController@setChatRoom');
    Route::post('filter-chat-users', 'ChatController@filterUserChatRooms');
    Route::delete('chatroom/{id}/delete', 'ChatController@destroyChatRoom');
    Route::post('notification-time/update', 'NotificationController@updateTime');

        /** Rutas para la gestión de correos */
    Route::post('email/settings', 'EmailController@setSetting');
    Route::get('email', 'EmailController@index')->name('email');
    Route::get('email/messages', 'EmailController@getMessages')->name('email.get-messages');
});

/* Routas para oportunidades */
Route::get('oportunitys', 'OportunyController@index')->name('oportunity.saved')->middleware('verified');
Route::get('list/oportunitys', 'OportunyController@showAll')->name('oportunity.list')->middleware('verified');
Route::get('create/{oportunity?}', 'OportunyController@showRegistrationOportunity')->name('oportunity.form')->middleware('verified');
Route::post('save', 'OportunyController@store')->name('oportunity.save')->middleware('verified');
Route::get('oportunity/image/{filename}', 'OportunyController@getImage')->name('oportunityImage')->middleware('verified');
Route::get('oportunity/{id}', 'OportunyController@showOportunity')->name('oportunity')->middleware('verified');


/* Rutas para postulaciones */
Route::post('postularme', 'AplicantController@store')->name('oportunity.postulation')->middleware('verified');
Route::get('postulados/{oportunity_id}', 'AplicantController@myaplicants')->name('oportunity.mispostulados')->middleware('verified');
Route::get('profile/aplicant/{id}', 'AplicantController@profilePostulant')->name('oportunity.profile')->middleware('verified');
Route::get('estatus/{id}/{estatus_postulations_id}', 'AplicantController@updateStatus')->name('oportunity.estatusUpdate')->middleware('verified');


/*Notificaciones */
Route::get('markAsRead', function () {
    auth()->user()->unreadNotifications->markAsRead();
});

// Route::get('test', function () {
//     event(new App\Events\PostulationOportunity('Someone'));
//     return "Event has been sent!";
// });

// Rutas para contacto
Route::get('contacto/listado', 'ContactController@index')->name('contact.list')->middleware('verified');
Route::get('contacto/crear/{contact?}', 'ContactController@create')->name('contact.create')->middleware('verified');
Route::post('contacto/save', 'ContactController@store')->name('contact.save')->middleware('verified');
Route::get('contacto/widget/{contacts?}', 'ContactController@show')->name('contact.show')->middleware('verified');
Route::get('contacto/image/{filename}', 'ContactController@getImage')->name('contact.image')->middleware('verified');
Route::get('contacto/eliminar/{contact_id}/{user_id}', 'ContactController@destroy')->name('contact.destroy')->middleware('verified');

Route::get('contacto/editar/{contact_id}', 'ContactController@edit')->name('contact.editForm')->middleware('verified');
Route::post('contacto/update', 'ContactController@update')->name('contact.update')->middleware('verified');

// Rutas para grupos

Route::get('grupos/crear', 'GroupController@show')->name('group.show')->middleware('verified');
Route::get('grupos/form', 'GroupController@create')->name('group.form')->middleware('verified');
Route::get('grupos/editar/{group_id}', 'GroupController@edit')->name('group.edit')->middleware('verified');
Route::post('grupos/saved', 'GroupController@store')->name('group.saved')->middleware('verified');
Route::post('grupos/update', 'GroupController@update')->name('group.update')->middleware('verified');

Route::get('grupos/confirmar/{invitacion_id}', 'GroupController@confirmAceptInvitation')->name('group.confirmInvitation')->middleware('verified');
Route::get('aceptar/{id_group}/{invitacion_id}', 'GroupController@aceptInvitation')->name('groups.confirm')->middleware('verified');
Route::get('rechazar/{id_group}/{invitacion_id}', 'GroupController@cancelInvitation')->name('groups.cancel')->middleware('verified');


// EM Modules
$router->group(['middleware' => ['verified']], function() use ($router) {

    // Notes module
    $router->get('todos', 'TodoController@index')->name('todos');
    
    // Email module
    $router->get('email', 'EmailController@index')->name('email');

    // Negotiations
    // Rutas para negociaciones Company
    $router->get('negociaciones', 'NegotiationController@index')->name('negociaciones');
    // $router->get('negociacion/save/{seller_profile_id}/{status_negociations_id}/{producto}/{responsable}/{estimado}', 'NegociationCompanyController@store')->name('negociationCompany.store')->middleware('verified');
});

Route::get('calender', 'EventController@index')->name('events.calender');

Route::view('dash','inicio-dashboard');