<?php

/**
 * File: ProjectTaskController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 27/02/16
 * Time: 15:33
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Http\Controllers;

use Illuminate\Http\Request;
use LACC\Http\Requests;
use LACC\Repositories\ProjectTaskRepository;
use LACC\Services\ProjectTaskService;

class ProjectTaskController extends Controller
{
		/**
		 * @var ProjectTaskRepository
		 */
		protected $repository;
		/**
		 * @var ProjectTaskService
		 */
		protected $service;

		public function __construct( ProjectTaskRepository $taskRepository, ProjectTaskService $service )
		{
				$this->repository = $taskRepository;
				$this->service    = $service;
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index( $id )
		{
//				return $this->service->all();
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
		public function update( Request $request, $taskId )
		{
				return $this->service->update( $request->all(), $taskId );
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
						$dataTask = $this->service->searchById( $id );
						if ( $dataTask[ 'success' ] ) {
								$this->repository->delete( $id );
								return response()->json( [
										'message' => 'Tarefa deletada com sucesso!',
								] );
						}
				} catch ( \Exception $e ) {
						return response()->json( [
								'message' => $e->getMessage(),
						] );
				}
		}
}
