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

use LACC\Entities\Client;
use LACC\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
		protected $defaultIncludes = [
				'members',
		];

		public function transform( Project $project )
		{
				return [
						'project_id'         => $project->id,
						'name_project'       => $project->name,
						'owner_id'           => $project->owner_id,
						'owner_name'         => $project->owner->name,
						'owner_email'        => $project->owner->email,
						'client_id'          => $project->client->id,
						'client_name'        => $project->client->name,
						'client_responsible' => $project->client->responsible,
						'client_email'       => $project->client->email,
						'client_phone'       => $project->client->phone,
						'description'        => $project->description,
						'progress'           => $project->progress,
						'status'             => $project->status,
						'due_date'           => $project->due_date,
				];
		}

		public function includeMembers( Project $project )
		{
				return $this->collection( $project->members, new ProjectMemberTransformer() );
		}
}