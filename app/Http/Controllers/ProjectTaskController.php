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
use LACC\Services\ProjectService;
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

		public function __construct( ProjectTaskRepository $taskRepository,
		                             ProjectTaskService $service )
		{
				$this->repository = $taskRepository;
				$this->service    = $service;
		}

		/**
		 * @param $id
		 *
		 * @return mixed
		 */
		public function index( $projectId, Request $request )
		{
//				return $this->repository->findWhere( [ 'project_id' => $id ] );
				$limit = $request->query->get( 'limit' );
				return $this->repository->findTaskByProject( $projectId, $limit );
		}

		/**
		 * @param Request $request
		 * @param $id
		 *
		 * @return array
		 */
		public function store( Request $request, $id )
		{
				$data                 = $request->all();
				$data[ 'project_id' ] = $id;

				return $this->service->create( $data );
		}

		/**
		 * @param $id
		 * @param $idTask
		 *
		 * @return mixed
		 */
		public function show( $id, $idTask )
		{
				//return $this->service->searchById( $idTask );
				return $this->repository->find( $idTask );
		}

		/**
		 * @param Request $request
		 * @param $id
		 * @param $idTask
		 *
		 * @return array|\Illuminate\Http\JsonResponse|mixed
		 */
		public function update( Request $request, $id, $idTask )
		{
				$data                 = $request->all();
				$data[ 'project_id' ] = $id;

				return $this->service->update( $data, $idTask );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( $id, $idTask )
		{
				try {
						$dataTask = $this->service->searchById( $idTask );

						if ( $dataTask ) {
								$this->service->delete( $idTask );
								return response()->json( [
										'success' => true,
										'message' => 'Tarefa deletada com sucesso!',
								] );

						}
				} catch ( \Exception $e ) {
						return response()->json( [
								'success ' => false,
								'message'  => $e->getMessage(),
						] );
				}
		}
}
