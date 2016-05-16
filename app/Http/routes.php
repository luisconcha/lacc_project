<?php

Route::get( '/', function () {
		return view( 'app' );
} );

Route::post( 'oauth/access_token', function () {
		return Response::json( Authorizer::issueAccessToken() );
} );

Route::group( [ 'middleware' => 'oauth' ], function () {

		//Rota para os usuarios
		Route::get( '/user/authenticated', [ 'as' => 'user.authenticated', 'uses' => 'UserController@authenticated' ] );

		//Rota para os clientes
		Route::get( '/clients', [ 'as' => 'clients.show', 'uses' => 'ClientController@index' ] );
		Route::group( [ 'prefix' => 'clients' ], function () {
				Route::post( '/', [ 'as' => 'client.create', 'uses' => 'ClientController@store' ] );
				Route::get( '/{id}', [ 'as' => 'client.show', 'uses' => 'ClientController@show' ] );
				Route::put( '/{id}', [ 'as' => 'client.update', 'uses' => 'ClientController@update' ] );
				Route::delete( '/{id}', [ 'as' => 'client.delete', 'uses' => 'ClientController@destroy' ] );

		} );
		//Rota lista projetos
		Route::get( '/projects', [ 'as' => 'projects.show', 'uses' => 'ProjectController@index' ] );
		//Route::resource( '/projects', 'ProjectController', [ 'except' => [ 'create', 'edit' ] ] );

		Route::group( [ 'prefix' => 'projects' ], function () {
				//Rota para os projetos
				Route::post( '/', [ 'as' => 'project.create', 'uses' => 'ProjectController@store' ] );
				Route::get( '/{id}', [ 'as' => 'project.show', 'uses' => 'ProjectController@show' ] );
				Route::put( '/{id}', [ 'as' => 'project.update', 'uses' => 'ProjectController@update' ] );
				Route::delete( '/{id}', [ 'as' => 'project.delete', 'uses' => 'ProjectController@destroy' ] );

				//Rotas para members
				Route::get( '/{idProject}/members', [ 'as' => 'project.members.show', 'uses' => 'ProjectController@showMembers' ] );
				Route::group( [ 'prefix' => 'member' ], function () {
						Route::post( 'project/{id}', [ 'as' => 'project.member.add', 'uses' => 'ProjectController@addMember' ] );
						Route::delete( 'project/{id}/user/{idUser}', [ 'as' => 'project.member.delete', 'uses' => 'ProjectController@removeMember' ] );
						Route::get( 'project/{id}/user/{idUser}', [ 'as' => 'project.member.ismember', 'uses' => 'ProjectController@isMember' ] );
				} );

				//Route::group( [ 'middleware' => 'check.project.permission', 'prefix' => 'projects' ], function () {
				Route::group( [ 'middleware' => 'check.project.permission' ], function () {
						//Rota para as notas
						Route::get( '{id}/notes', [ 'as' => 'project.notes.show', 'uses' => 'ProjectNoteController@index' ] );
						Route::get( '{id}/note/{noteId}', [ 'as' => 'project.note.show', 'uses' => 'ProjectNoteController@show' ] );
						Route::post( '{id}/note', [ 'as' => 'project.note.create', 'uses' => 'ProjectNoteController@store' ] );
						Route::put( '/{id}/note/{noteId}', [ 'as' => 'project.note.update', 'uses' => 'ProjectNoteController@update' ] );
						Route::delete( '/{id}/note/{noteId}', [ 'as' => 'project.note.delete', 'uses' => 'ProjectNoteController@destroy' ] );

						//Rotas para a tasks
						Route::get( '{projectId}/tasks', [ 'as' => 'project.tasks.show', 'uses' => 'ProjectTaskController@index' ] );
						Route::group( [ 'prefix' => 'task' ], function () {
								Route::get( '{id}/task/{taskId}', [ 'as' => 'project.task.show', 'uses' => 'ProjectTaskController@show' ] );
								Route::post( '{id}/task', [ 'as' => 'project.task.create', 'uses' => 'ProjectTaskController@store' ] );
								Route::put( '{id}/task/{taskId}', [ 'as' => 'project.task.update', 'uses' => 'ProjectTaskController@update' ] );
								Route::delete( '{id}/task/{taskId}', [ 'as' => 'project.task.delete', 'uses' => 'ProjectTaskController@destroy' ] );
						} );

						//Rota para arquivos
						Route::get( '{id}/file', [ 'as' => 'project.file.list', 'uses' => 'ProjectFileController@index' ] );
						Route::get( '{id}/file/{fileId}', [ 'as' => 'project.file.show', 'uses' => 'ProjectFileController@show' ] );
						Route::get( '{id}/file/{fileId}/download', [ 'as' => 'project.file.download', 'uses' => 'ProjectFileController@showFile' ] );
						Route::post( '{id}/file', [ 'as' => 'project.file.add', 'uses' => 'ProjectFileController@store' ] );
						Route::put( '{id}/file/{fileId}', [ 'as' => 'project.file.edit', 'uses' => 'ProjectFileController@update' ] );
						Route::delete( '{id}/file/{fileId}', [ 'as' => 'project.file.delete', 'uses' => 'ProjectFileController@destroy' ] );
				} );
		} );

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