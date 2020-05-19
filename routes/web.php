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
        return view('search-result');
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
});

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
Route::get('buscar-vendedores', 'HomeController@index')->name('search.init')->middleware('verified');
Route::post('buscar-vendedores', 'HomeController@search')->name('search')->middleware('verified');
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
});

/* Routas para oportunidades */
Route::get('oportunidades', 'OportunyController@index')->name('oportunity');
Route::get('crear', 'OportunyController@showRegistrationOportunity')->name('oportunityForm');
Route::post('save', 'OportunyController@store')->name('previusOportunity');
Route::post('publish', 'OportunyController@save')->name('oportunitySave');
Route::get('oportunity/image/{filename}', 'OportunyController@getImage')->name('oportunityImage');


