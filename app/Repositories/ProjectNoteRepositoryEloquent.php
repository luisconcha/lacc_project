<?php

namespace LACC\Repositories;

use LACC\Presenters\ProjectNotePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LACC\Repositories\ProjectNoteRepository;
use LACC\Entities\ProjectNote;

/**
 * Class ProjectNoteRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
		/**
		 * Specify Model class name
		 *
		 * @return string
		 */
		public function model()
		{
				return ProjectNote::class;
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
				return ProjectNotePresenter::class;
		}
}
