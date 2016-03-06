<?php

/**
 * File: ProjectTaskRepositoryEloquent.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 21/02/16
 * Time: 16:33
 * Project: lacc_project
 * Copyright: 2016
 */
namespace LACC\Repositories;

use LACC\Presenters\ProjectTaskPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LACC\Repositories\ProjectTaskRepository;
use LACC\Entities\ProjectTask;

/**
 * Class ProjectTaskRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{
		/**
		 * Specify Model class name
		 *
		 * @return string
		 */
		public function model()
		{
				return ProjectTask::class;
		}

		/**
		 * Boot up the repository, pushing criteria
		 */
		public function boot()
		{
				$this->pushCriteria( app( RequestCriteria::class ) );
		}

		public function presenter()
		{
				return ProjectTaskPresenter::class;
		}
}
