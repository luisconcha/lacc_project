<?php

namespace LACC\Http\Controllers;

use Illuminate\Http\Request;
use LACC\Http\Requests;
use LACC\Repositories\ProjectRepository;
use LACC\Services\ProjectService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{
		/**
		 * @var ProjectRepository
		 */
		protected $repository;
		/**
		 * @var ProjectService
		 */
		protected $service;

		public function __construct( ProjectRepository $repository, ProjectService $service )
		{
				$this->repository = $repository;
				$this->service    = $service;
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
				$ownerId = Authorizer::getResourceOwnerId();

				return $this->repository->findWhere( [ 'owner_id' => $ownerId ] );
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
		public function show( $id )
		{
				if ( !$this->service->checkProjectPermissions( $id ) ):
						return [ 'error' => 'Access Forbidden' ];
				endif;

				return $this->service->searchById( $id );
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( Request $request, $id )
		{
				if ( $this->service->checkProjectPermissions( $id ) == false ):
						return [ 'error' => 'Access Forbidden' ];
				endif;

				return $this->service->update( $request->all(), $id );
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
				if ( $this->service->checkProjectPermissions( $id ) == false ):
						return [ 'error' => 'Access Forbidden' ];
				endif;

				try {
						$dataProject = $this->service->searchById( $id );

						if ( $dataProject[ 'success' ] ) {
								$this->repository->delete( $id );

								return response()->json( [
										'message' => 'Projeto deletado com sucesso!',
								] );
						}
				} catch ( \Exception $e ) {
						return response()->json( [
								'message' => $e->getMessage(),
						] );
				}
		}

		/*********************************************************
		 *     M E M B R O S  D O  P R O J E T O                 *
		 *********************************************************/


		public function showMembers( $idProject )
		{
				return $this->service->showMembers( $idProject );
		}

		public function addMember( $idProject, Request $request )
		{
				$userId = $request->get( 'user_id' );
				return $this->service->addMember( $idProject, $userId );
		}

		public function removeMember( $idProject, $userId )
		{
				return $this->service->removeMember( $idProject, $userId );
		}

		public function isMember( $idProject, $userId )
		{
				return $this->service->isMember( $idProject, $userId );
		}

//		private function checkProjectOwner( $projectId )
//		{
//				$userId = Authorizer::getResourceOwnerId();
//
//				return $this->repository->isOwner( $projectId, $userId );
//
//		}
//
//		private function checkProjectMember( $projectId )
//		{
//				$userId = Authorizer::getResourceOwnerId();
//
//				return $this->repository->hasMember( $projectId, $userId );
//		}
//
//		private function checkProjectPermissions( $projectId )
//		{
//				if ( $this->checkProjectOwner( $projectId ) or $this->checkProjectMember( $projectId ) ) :
//						return true;
//				endif;
//
//				return false;
//		}
}