<?php
/**
 * File: ProjectNoteController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 21/02/16
 * Time: 12:37
 * Project: lacc_project
 * Copyright: 2016
 */


namespace LACC\Http\Controllers;

use Illuminate\Http\Request;
use LACC\Http\Requests;
use LACC\Repositories\ProjectNoteRepository;
use LACC\Services\ProjectNoteService;

class ProjectNoteController extends Controller
{
		/**
		 * @var ProjectNoteRepository
		 */
		protected $repository;
		/**
		 * @var ProjectNoteService
		 */
		protected $service;

		public function __construct( ProjectNoteRepository $repository, ProjectNoteService $service )
		{
				$this->repository = $repository;
				$this->service    = $service;
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index( $id )
		{
				return $this->repository->findWhere( [ 'project_id' => $id ] );
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store( Request $request )
		{
				return $this->service->create( $request->all() );
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show( $noteId )
		{
				return $this->service->searchNoteById( $noteId );
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( Request $request, $noteId )
		{
				return $this->service->update( $request->all(), $noteId );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( $id )
		{
				try {
						$dataProject = $this->service->searchNoteById( $id );

						if ( $dataProject[ 'success' ] ) {
								$this->repository->delete( $id );

								return response()->json( [
										'message' => 'Nota deletada com sucesso!',
								] );
						}
				} catch ( \Exception $e ) {
						return response()->json( [
								'message' => $e->getMessage(),
						] );
				}
		}
}