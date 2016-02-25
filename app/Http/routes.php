<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get( '/', function () {
		return view( 'welcome' );
} );

Route::group( [ 'prefix' => 'client' ], function () {
		Route::get( '', 'ClientController@index' );
		Route::post( '', 'ClientController@store' );
		Route::get( '{id}', 'ClientController@show' );
		Route::put( '{id}', 'ClientController@update' );
		Route::delete( '{id}', 'ClientController@destroy' );

} );

Route::group( [ 'prefix' => 'project' ], function () {
		Route::get( '', 'ProjectController@index' );
		Route::post( '', 'ProjectController@store' );
		Route::get( '{id}', 'ProjectController@show' );
		Route::put( '{id}', 'ProjectController@update' );
		Route::delete( '{id}', 'ProjectController@destroy' );
} );


/*****************************
 *  TESTE UNITÁRIOS
 *****************************/
Route::get( '/ola', function () {
		return 'Olá mundo!';
} );

//Desabilitar o CSRF para funcionar o teste (arquivo Kernel) mais neste curso já foi desabilitado
Route::post( '/post', function ( \Illuminate\Http\Request $request ) {
		$name  = $request->name;
		$idade = $request->idade;
		$email = $request->email;
		return response()->json( compact( 'name', 'idade', 'email' ) );
} );