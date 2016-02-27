<?php

namespace LACC\Http\Controllers;

use Illuminate\Http\Request;
use LACC\Http\Requests;
use LACC\Repositories\ProjectRepository;
use LACC\Services\ProjectService;

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
				return $this->service->all();
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

		public function showMembers( $idProject )
		{
				return $this->service->showMembers( $idProject );
		}
}
