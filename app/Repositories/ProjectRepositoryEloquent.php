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
		public function model()
		{
				return Project::class;
		}

		public function isOwner( $projectId, $userId )
		{
				$data = $this->findWhere( [ 'id' => $projectId, 'owner_id' => $userId ] );

				if ( count( $data[ 'data' ] ) ):
						return true;
				endif;

				return false;
		}

		public function hasMember( $projectId, $memberId )
		{
				$project = $this->find( $projectId );

				foreach ( $project[ 'data' ][ 'members' ] as $member ):
						foreach ( $member as $memberId ):
								if ( $memberId[ 'member_id' ] == $memberId ):
									 return true;
								endif;
						endforeach;
				endforeach;

//				foreach ( $project->members as $member ) :
//						if ( $member->id == $memberId ):
//								return true;
//						endif;
//				endforeach;

				return false;
		}

		public function presenter()
		{
				return ProjectPresenter::class;
		}
}