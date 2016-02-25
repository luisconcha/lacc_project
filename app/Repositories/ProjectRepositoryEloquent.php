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
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
		public function model()
		{
				return Project::class;
		}
}