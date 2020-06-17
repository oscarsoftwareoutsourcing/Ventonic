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

Route::get('calender', function () {
    if (auth()->check()) {
        return view('calender');
    }
    return view('welcome');
})->name('events.calender');

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


// Rutas para negociaciones Company
Route::get('negociaciones/empresa', 'NegociationCompanyController@index')->name('negociationCompany.index')->middleware('verified');
Route::get('negociacion/save/{seller_profile_id}/{status_negociations_id}/{producto}/{responsable}/{estimado}', 'NegociationCompanyController@store')->name('negociationCompany.store')->middleware('verified');


// Rutas para contacto
Route::get('contacto/listado', 'ContactController@index')->name('contact.list')->middleware('verified');
Route::get('contacto/crear/{contact?}', 'ContactController@create')->name('contact.create')->middleware('verified');
Route::post('contacto/save', 'ContactController@store')->name('contact.save')->middleware('verified');
Route::get('contacto/widget/{contacts?}', 'ContactController@show')->name('contact.show')->middleware('verified');
Route::get('contacto/widget/{contacts?}', 'ContactController@show')->name('contact.show')->middleware('verified');
Route::get('contacto/image/{filename}', 'ContactController@getImage')->name('contact.image')->middleware('verified');
Route::get('contacto/eliminar/{contact_id}/{user_id}', 'ContactController@destroy')->name('contact.destroy')->middleware('verified');

Route::get('contacto/editar/{contact_id}', 'ContactController@edit')->name('contact.editForm')->middleware('verified');
Route::post('contacto/update', 'ContactController@update')->name('contact.update')->middleware('verified');

// Rutas para grupos

Route::get('grupos/crear', 'GroupController@show')->name('group.show')->middleware('verified');


// Notes module
$router->group(['middleware' => ['verified']], function() use ($router) {
    $router->get('todos', 'TodoController@index')->name('todos');
});

Route::view('dash','inicio-dashboard');