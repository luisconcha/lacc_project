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


		public function findNoteByProject( $projectId, $limit = null, $columns = array() )
		{
				/**
				 * Consulta via queryBuilder(scopeQuery) do Prettus
				 * @see https://github.com/andersao/l5-repository
				 */
				return $this->scopeQuery( function ( $query ) use ( $projectId ) {
						return $query->select( 'project_notes.*' )
								->where( 'project_notes.project_id', '=', $projectId );
				} )->paginate( $limit, $columns );
		}

		/**
		 * return response()->json( $this->repository->with( [ 'project' ] )->paginate(1)
		->where( [ 'project_id' => $id ] ) );
		 */
}
