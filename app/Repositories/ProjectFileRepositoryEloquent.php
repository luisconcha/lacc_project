<?php
/**
 * File: ProjectFileRepositoryEloquent.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 24/02/16
 * Time: 20:50
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Repositories;

use LACC\Entities\ProjectFile;
use LACC\Presenters\ProjectFilePresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
		public function model()
		{
				return ProjectFile::class;
		}

		public function presenter()
		{
				return ProjectFilePresenter::class;
		}
}