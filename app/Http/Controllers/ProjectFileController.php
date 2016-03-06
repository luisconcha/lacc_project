<?php

namespace LACC\Http\Controllers;

use Illuminate\Http\Request;
use LACC\Repositories\ProjectRepository;
use LACC\Services\ProjectService;
use LACC\Validators\ProjectFileValidator;
use Prettus\Validator\Exceptions\ValidatorException;

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
		/**
		 * @var ProjectFileValidator
		 */
		protected $fileValidator;

		public function __construct( ProjectRepository $repository, ProjectService $service, ProjectFileValidator $fileValidator )
		{
				$this->repository    = $repository;
				$this->service       = $service;
				$this->fileValidator = $fileValidator;
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
				if ( is_null( $request->file( 'file' ) ) ) :
						return response()->json( [
								'success' => false,
								'message' => 'Por favor, anexe um arquivo para upload!',
						] );
				else:
						$file      = $request->file( 'file' );
						$extension = $file->getClientOriginalExtension();
				endif;

				$name        = $request->name;
				$description = $request->description;
				$projectId   = $request->project_id;

				$data = [
						'file'        => $file,
						'extension'   => $extension,
						'name'        => $name,
						'description' => $description,
						'project_id'  => $projectId,
				];

				try {
						$this->fileValidator->with( $data )->passesOrFail();

						return $this->service->createFile( $data );
				} catch ( ValidatorException $e ) {
						return response()->json( [
								'error'   => true,
								'message' => $e->getMessageBag(),
						] );
				}
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
		 * @param  int $projectId $idFile
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( $projectId, $idFile )
		{
				return $this->service->deleteFile( $projectId, $idFile );
		}
}