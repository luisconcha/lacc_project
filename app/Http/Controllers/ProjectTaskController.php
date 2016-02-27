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
		 * @var ProjectTaskRe
		 */
		protected $repository;
		/**
		 * @var ProjectTaskService
		 */
		protected $service;


		public function __construct( ProjectTaskRepository $taskRepository ,ProjectTaskService $service )
		{
				$this->repository = $taskRepository;
				$this->service = $service;
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
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
				//
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
				//
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
				//
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit( $id )
		{
				//
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
				//
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
				//
		}
}
