<?php
/**
 * File: ProjectService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 24/02/16
 * Time: 20:55
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Services;

use LACC\Repositories\ProjectRepository;
use LACC\Validators\ProjectValidator;

class ProjectService extends BaseService
{
		/**
		 * @var ProjectRepository
		 */
		protected $repository;
		/**
		 * @var ProjectValidator
		 */
		protected $validator;

		public function __construct( ProjectRepository $repository, ProjectValidator $validator )
		{
				$this->repository = $repository;
				$this->validator  = $validator;
		}

		public function all()
		{
				return response()->json( $this->repository->with( [
						'owner',
						'client',
				] )->all() );

		}
}