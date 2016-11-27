<?php
/**
 * File: ProjectRepositoryEloquent.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 24/02/16
 * Time: 20:50
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Repositories;

use LACC\Entities\Project;
use LACC\Presenters\ProjectPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
		protected $skipPresenter = true;

		public function model()
		{
				return Project::class;
		}

		public function isOwner( $projectId, $userId )
		{
				if ( count( $this->skipPresenter()->findWhere( [ 'id' => $projectId, 'owner_id' => $userId ] ) ) ):
						return true;
				endif;

				return false;
		}

		public function hasMember( $projectId, $memberId )
		{
				$project = $this->skipPresenter()->find( $projectId );
				foreach ( $project->members as $member ):
						if ( $member->id == $memberId ):
								return true;
						endif;
				endforeach;

				return false;
		}

		public function findWithOwnerAndMember( $userId )
		{
				/**
				 * Consulta via queryBuilder(scopeQuery) do Prettus
				 * @see https://github.com/andersao/l5-repository
				 */
				return $this->scopeQuery( function ( $query ) use ( $userId ) {
						return $query->select( 'projects.*' )
								->leftJoin( 'project_members', 'project_members.user_id', '=', 'projects.owner_id' )
								->where( 'project_members.user_id', '=', $userId )
								->union( $this->model->query()->getQuery()->where( 'owner_id', '=', $userId ) );
				} )->all();
		}

		public function findOwner( $userId, $limit = null, $columns = array() )
		{
				/**
				 * Consulta via queryBuilder(scopeQuery) do Prettus
				 * @see https://github.com/andersao/l5-repository
				 */
				return $this->scopeQuery( function ( $query ) use ( $userId ) {
						return $query->select( 'projects.*' )
								->where( 'projects.owner_id', '=', $userId );
				} )->paginate( $limit, $columns );
		}

		public function presenter()
		{
				return ProjectPresenter::class;
		}
}