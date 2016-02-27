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

Route::get( '/clients', [ 'as' => 'clients.show', 'uses' => 'ClientController@index' ] );
Route::group( [ 'prefix' => 'client' ], function () {
		Route::post( '/', [ 'as' => 'client.create', 'uses' => 'ClientController@store' ] );
		Route::get( '/{id}', [ 'as' => 'client.show', 'uses' => 'ClientController@show' ] );
		Route::put( '/{id}', [ 'as' => 'client.update', 'uses' => 'ClientController@update' ] );
		Route::delete( '/{id}', [ 'as' => 'client.delete', 'uses' => 'ClientController@destroy' ] );

} );

Route::get( '/projects', [ 'as' => 'projects.show', 'uses' => 'ProjectController@index' ] );
Route::group( [ 'prefix' => 'project' ], function () {

		//Rota para as notas
		Route::get( '{id}/notes', [ 'as' => 'project.notes.show', 'uses' => 'ProjectNoteController@index' ] );
		Route::group( [ 'prefix' => 'note' ], function () {
				Route::post( '/', [ 'as' => 'project.note.create', 'uses' => 'ProjectNoteController@store' ] );
				Route::get( '/{noteId}', [ 'as' => 'project.note.show', 'uses' => 'ProjectNoteController@show' ] );
				Route::put( '/{noteId}', [ 'as' => 'project.note.update', 'uses' => 'ProjectNoteController@update' ] );
				Route::delete( '/{noteId}', [ 'as' => 'project.note.delete', 'uses' => 'ProjectNoteController@destroy' ] );

		} );

		//Rotas para a tasks
		Route::get( '{id}/tasks', [ 'as' => 'project.tasks.show', 'uses' => 'ProjectTaskController@index' ] );


		Route::post( '/', [ 'as' => 'project.create', 'uses' => 'ProjectController@store' ] );
		Route::get( '/{id}', [ 'as' => 'project.show', 'uses' => 'ProjectController@show' ] );
		Route::put( '/{id}', [ 'as' => 'project.update', 'uses' => 'ProjectController@update' ] );
		Route::delete( '/{id}', [ 'as' => 'project.delete', 'uses' => 'ProjectController@destroy' ] );
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