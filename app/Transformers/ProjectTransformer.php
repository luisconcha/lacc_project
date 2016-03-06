<?php
/**
 * File: ProjectTransformer.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 05/03/16
 * Time: 23:16
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Transformers;

use LACC\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
		public function transform( Project $project )
		{
				return [
						'project_id'  => $project->id,
						'name'        => $project->name,
						'client_id'   => $project->client_id,
						'owner_id'    => $project->owner_id,
						'description' => $project->description,
						'progress'    => $project->progress,
						'status'      => $project->status,
						'due_date'    => $project->due_date,
				];
		}
}