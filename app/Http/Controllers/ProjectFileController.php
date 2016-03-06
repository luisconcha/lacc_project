<?php

namespace LACC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use LACC\Http\Requests;
use LACC\Repositories\ProjectRepository;
use LACC\Services\ProjectService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectFileController extends Controller
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
				$file        = $request->file( 'file' );
				$extension   = $file->getClientOriginalExtension();
				$nomeArquivo = str_replace( ' ', '_', $request->name );
				$description = $request->description;
				$projectId   = $request->project_id;

				$data = [
						'file'        => $file,
						'extension'   => $extension,
						'name'        => $nomeArquivo,
						'description' => $description,
						'project_id'  => $projectId,
				];

				$this->service->createFile( $data );
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
		}
}