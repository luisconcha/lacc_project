<?php

namespace LACC\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LACC\Repositories\ProjectMembersRepository;
use LACC\Entities\ProjectMembers;

/**
 * Class ProjectMembersRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class ProjectMembersRepositoryEloquent extends BaseRepository implements ProjectMembersRepository
{
		//@seed: https://github.com/andersao/l5-repository#create-a-criteria
		protected $fieldSearchable = [
				'name',
		];

		/**
		 * Specify Model class name
		 *
		 * @return string
		 */
		public function model()
		{
				return ProjectMembers::class;
		}

		/**
		 * Boot up the repository, pushing criteria
		 */
		public function boot()
		{
				$this->pushCriteria( app( RequestCriteria::class ) );
		}
}
