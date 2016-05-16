<?php
/**
 * File: ProjectFileService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 24/02/16
 * Time: 20:55
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Services;

use LACC\Repositories\ProjectFileRepository;
use LACC\Repositories\ProjectRepository;
use LACC\Validators\ProjectFileValidator;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


class ProjectFileService
{
		/**
		 * @var ProjectFileRepository
		 */
		protected $repository;
		/**
		 * @var ProjectRepository
		 */
		protected $projectRepository;
		/**
		 * @var ProjectFileValidator
		 */
		protected $validatorFiles;
		/**
		 * @var Filesystem
		 */
		protected $filesystem;
		/**
		 * @var Storage
		 */
		protected $storage;

		public function __construct( ProjectFileRepository $repository,
		                             ProjectRepository $projectRepository,
		                             ProjectFileValidator $projectFileValidator,
		                             Filesystem $filesystem,
		                             Storage $storage )
		{
				$this->repository        = $repository;
				$this->projectRepository = $projectRepository;
				$this->validatorFiles    = $projectFileValidator;
				$this->filesystem        = $filesystem;
				$this->storage           = $storage;
		}

		public function createFile( array $data )
		{
				try {
						$this->validatorFiles->with( $data )->passesOrFail( ValidatorInterface::RULE_CREATE );

						$project     = $this->projectRepository->skipPresenter()->find( $data[ 'project_id' ] );
						$projectFile = $project->files()->create( $data );

						//Envia arquivo para o storage
						$this->storage->put( $projectFile->getFileName(), $this->filesystem->get( $data[ 'file' ] ) );

						return $projectFile;

				} catch ( ValidatorException $e ) {
						return [
								'error'   => true,
								'message' => $e->getMessageBag(),
						];
				}
		}

		public function update( array $data, $id )
		{
				try {
						$this->validatorFiles->with( $data )->passesOrFail( ValidatorInterface::RULE_UPDATE );

						return $this->repository->update( $data, $id );

				} catch ( ValidatorException $e ) {
						return [
								'error'   => true,
								'message' => $e->getMessageBag(),
						];
				}
		}

		public function delete( $id )
		{
				$projectFile = $this->repository->skipPresenter()->find( $id );

				if ( $this->storage->exists( $projectFile->getFileName() ) ) {
						$this->storage->delete( $projectFile->getFileName() );

						return $projectFile->delete();
				}
		}

		public function getFilePath( $id )
		{
				$projectFile = $this->repository->skipPresenter()->find( $id );

				return $this->getBaseURL( $projectFile );
		}

		public function getFileName( $id )
		{
				$projectFile = $this->repository->skipPresenter()->find( $id );

				return $projectFile->getFileName();
		}

		private function getBaseURL( $projectFile )
		{
				//Verifica o driver utilizado
				switch ( $this->storage->getDefaultDriver() ) {

						case 'local':
								return $this->storage->getDriver()->getAdapter()->getPathPrefix() . '/' . $projectFile->getFileName();
				}
		}
}