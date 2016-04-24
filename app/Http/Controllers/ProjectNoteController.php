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
use LACC\Services\ProjectService;

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
		/**
		 * @var ProjectService
		 */
		protected $projectService;

		public function __construct( ProjectNoteRepository $repository,
		                             ProjectNoteService $service,
		                             ProjectService $projectService )
		{
				$this->repository     = $repository;
				$this->service        = $service;
				$this->projectService = $projectService;
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index( $id, Request $request )
		{
				$projectId = $request->projectId;

				if ( !$this->projectService->checkProjectPermissions( $projectId ) ):
						return [ 'error' => 'Access Forbidden' ];
				endif;

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
				$projectId = $request->projectId;

				if ( !$this->projectService->checkProjectPermissions( $projectId ) ):
						return [ 'error' => 'Access Forbidden' ];
				endif;

				return $this->service->create( $request->all() );
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show( $noteId, Request $request )
		{
				$projectId = $request->id;
				if ( !$this->projectService->checkProjectPermissions( $projectId ) ):
						return [ 'error' => 'Access Forbidden' ];
				endif;

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
		public function update( Request $request, $idProjetc, $noteId )
		{
				if ( !$this->projectService->checkProjectPermissions( $idProjetc ) ):
						return [ 'error' => 'Access Forbidden' ];
				endif;


				return $this->service->update( $request->all(), $noteId );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( Request $request, $idProjetc, $idNote )
		{
				if ( !$this->projectService->checkProjectPermissions( $idProjetc ) ):
						return [ 'error' => 'Access Forbidden' ];
				endif;


				try {
						$dataProject = $this->service->searchNoteById( $idProjetc );

						if ( $dataProject ) {
								$this->repository->delete( $idNote );

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
