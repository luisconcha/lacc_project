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


use LACC\Repositories\ProjectTaskRepository;
use LACC\Validators\ProjectTaskValidator;

class ProjectTaskService extends BaseService
{
		/**
		 * @var ProjectTaskRepository
		 */
		protected $repository;
		/**
		 * @var ProjectTaskValidator
		 */
		protected $validator;

		public function __construct( ProjectTaskRepository $repository, ProjectTaskValidator $validator )
		{
				$this->repository = $repository;
				$this->validator  = $validator;
		}

		public function all()
		{
				return response()->json(
						$this->repository->with( [
								'project',
						] )->all() );
		}
}