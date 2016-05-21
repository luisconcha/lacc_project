<?php
/**
 * File: ProjectTaskService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 27/02/16
 * Time: 15:21
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Services;


use LACC\Repositories\ProjectRepository;
use LACC\Repositories\ProjectTaskRepository;
use LACC\Validators\ProjectTaskValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService extends BaseService
{
		/**
		 * @var ProjectTaskRepository
		 */
		protected $repository;
		/**
		 * @var ProjectRepository
		 */
		protected $projectRepository;
		/**
		 * @var ProjectTaskValidator
		 */
		protected $validator;

		public function __construct( ProjectTaskRepository $repository, ProjectRepository $projectRepository, ProjectTaskValidator $validator )
		{
				$this->repository        = $repository;
				$this->projectRepository = $projectRepository;
				$this->validator         = $validator;
		}

		public function create( array $data )
		{
				try {
						$this->validator->with( $data )->passesOrFail( ValidatorInterface::RULE_CREATE );

						$project     = $this->projectRepository->skipPresenter()->find( $data[ 'project_id' ] );
						$projectTask = $project->tasks()->create( $data );

						return $projectTask;

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

						$this->validator->with( $data )->passesOrFail( ValidatorInterface::RULE_UPDATE );

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
				$projectTask = $this->repository->skipPresenter()->find( $id );

				return $projectTask->delete( $id );
		}

		public function all()
		{
				return response()->json(
						$this->repository->with( [
								'project',
						] )->all() );
		}
}