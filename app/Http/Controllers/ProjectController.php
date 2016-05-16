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

				$this->middleware( 'check.project.owner', [ 'except' => [ 'index', 'store', 'show' ] ] );
				$this->middleware( 'check.project.permission', [ 'except' => [ 'index', 'store', 'update', 'destroy' ] ] );
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
				//Id do usuário autenticado
				$userId = Authorizer::getResourceOwnerId();

				return $this->repository->findWithOwnerAndMember( $userId );
		}

		/**
		 * @param Request $request
		 *
		 * @return array
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
//				if ( !$this->service->checkProjectPermissions( $id ) ):
//						return [ 'error' => 'Access Forbidden' ];
//				endif;

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
//				if ( !$this->service->checkProjectPermissions( $id ) ):
//						return [ 'error' => 'Access Forbidden' ];
//				endif;

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
//				if ( !$this->service->checkProjectPermissions( $id ) ):
//						return [ 'error' => 'Access Forbidden' ];
//				endif;

				try {
						$dataProject = $this->service->searchById( $id );

						if ( $dataProject ) {
								if ( $this->repository->delete( $id ) ) {
										return response()->json( [ 'success' => 'O Projeto foi deletado com sucesso!' ] );
								}
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

		public function showMembers( $projectId )
		{
				return $this->service->showMembers( $projectId );
		}

		public function addMember( $projectId, Request $request )
		{
				$userId = $request->get( 'user_id' );
				return $this->service->addMember( $projectId, $userId );
		}

		public function removeMember( $projectId, $userId )
		{
				return $this->service->removeMember( $projectId, $userId );
		}

		public function isMember( $projectId, $userId )
		{
				return $this->service->isMember( $projectId, $userId );
		}
}