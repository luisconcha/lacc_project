<?php

namespace LACC\Http\Controllers;

use Illuminate\Http\Request;
use LACC\Repositories\ProjectFileRepository;
use LACC\Services\ProjectFileService;
use LACC\Validators\ProjectFileValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectFileController extends Controller
{
		/**
		 * @var ProjectFileRepository
		 */
		protected $repository;
		/**
		 * @var ProjectFileService
		 */
		protected $service;
		/**
		 * @var ProjectFileValidator
		 */
		protected $fileValidator;

		public function __construct( ProjectFileRepository $repository, ProjectFileService $service, ProjectFileValidator $fileValidator )
		{
				$this->repository    = $repository;
				$this->service       = $service;
				$this->fileValidator = $fileValidator;
		}

		/**
		 * @param $id
		 *
		 * @return mixed
		 */
		public function index( $id )
		{
				return $this->repository->findWhere( [ 'project_id' => $id ] );
//				return $this->repository->skipPresenter()->findWhere( [ 'project_id' => $id ] );
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
						return $this->service->createFile( $data );
				} catch ( ValidatorException $e ) {
						return response()->json( [
								'error'   => true,
								'message' => $e->getMessageBag(),
						] );
				}
		}

		/**
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function showFile( $id )
		{
				if ( $this->service->checkProjectPermissions( $id ) == false ) {
						return [ 'error' => 'Access Forbidden' ];
				}

				$filePath    = $this->service->getFilePath( $id );
				$fileContent = file_get_contents( $filePath );
				$file64      = base64_encode( $fileContent );

				return [
						'file' => $file64,
						'size' => filesize( $filePath ),
						'name' => $this->service->getFileName( $id ),
				];
		}

		/**
		 * @param $id
		 *
		 * @return array|mixed
		 */
		public function show( $id )
		{
//				if ( $this->service->checkProjectPermissions( $id ) == false ) {
//						return [ 'error' => 'Access Forbidden' ];
//				}
				return $this->repository->find( $id );
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
//				if ( $this->service->checkProjectOwner( $id ) ) {
//						return [ 'error' => 'Access Forbidden' ];
//				}

				return $this->service->update( $request->all(), $id );
		}

		/**
		 * @param $id
		 *
		 * @return array
		 */
		public function destroy( $id )
		{
				if ( $this->service->checkProjectOwner( $id ) == false ) {
						return [ 'error' => 'Access Forbidden' ];
				}

				$this->service->delete( $id );
		}
}