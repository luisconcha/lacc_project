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
		 * @param $projectId
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function index( $projectId )
		{
//				return $this->repository->findWhere( [ 'project_id' => $projectId ] );
				return $this->service->all( $projectId );
		}

		/**
		 * @param Request $request
		 * @param $projectId
		 *
		 * @return array
		 */
		public function store( Request $request, $projectId )
		{
				$data                 = $request->all();
				$data[ 'project_id' ] = $projectId;

				return $this->service->create( $data );
		}

		/**
		 * @param $projectId
		 * @param $noteId
		 *
		 * @return array|mixed
		 */
		public function show( $projectId, $noteId )
		{
				$result = $this->repository->findWhere( [ 'project_id' => $projectId, 'id' => $noteId ] );
				if ( isset( $result[ 'data' ] ) && count( $result[ 'data' ] ) == 1 ):
						$result = [
								'data' => $result[ 'data' ][ 0 ],
						];
				endif;

				return $result;
		}

		/**
		 * @param Request $request
		 * @param $projectId
		 * @param $noteId
		 *
		 * @return \Illuminate\Http\JsonResponse|mixed
		 */
		public function update( Request $request, $projectId, $noteId )
		{
				$data                 = $request->all();
				$data[ 'project_id' ] = $projectId;

				return $this->service->update( $data, $noteId );
		}

		/**
		 * @param $projectId
		 * @param $idNote
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function destroy( $projectId, $idNote )
		{
				try {
						$dataProject = $this->service->searchNoteById( $projectId );

						if ( $dataProject ) {

								if ( $this->repository->delete( $idNote ) ) {
										return response()->json( [ 'success' => 'A nota do projeto foi deletada com sucesso!' ] );
								}
						}
				} catch ( \Exception $e ) {
						return response()->json( [
								'message' => $e->getMessage(),
						] );
				}
		}
}
