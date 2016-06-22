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
				'client',
				'notes',
				'tasks',
				'files',
		];
//		protected $avaliableIncludes = [
//				'members',
//				'client',
//				'notes',
//				'tasks',
//				'files'
//		];

		public function transform( Project $project )
		{
				return [
						'project_id'         => $project->id,
						'name'               => $project->name,
						'owner_id'           => $project->owner_id,
						'owner_name'         => $project->owner->name,
						'owner_email'        => $project->owner->email,
						'client_id'          => $project->client->id,
						'client_name'        => $project->client->name,
						'client_responsible' => $project->client->responsible,
						'client_email'       => $project->client->email,
						'client_phone'       => $project->client->phone,
						'description'        => $project->description,
						'progress'           => (int)$project->progress,
						'status'             => $project->status,
						'due_date'           => $project->due_date,
						'created_at'         => $project->created_at,
						'is_member'          => $project->owner_id != \Authorizer::getResourceOwnerId(),
						'tasks_count'        => $project->tasks->count(),
						'task_opened'        => $this->countTasksOpened( $project ),
				];
		}

		public function includeMembers( Project $project )
		{
				return $this->collection( $project->members, new ProjectMemberTransformer() );
		}

		public function includeNotes( Project $project )
		{
				return $this->collection( $project->notes, new ProjectNoteTransformer() );
		}

		public function includeFiles( Project $project )
		{
				return $this->collection( $project->files, new ProjectFileTransformer() );
		}

		public function includeTasks( Project $project )
		{
				return $this->collection( $project->tasks, new ProjectTaskTransformer() );
		}

		public function includeClient( Project $project )
		{
				return $this->item( $project->client, new ClientTransformer() );
		}

		/**
		 * Função que verifica as tarefas em aberto
		 *
		 * @param Project $project
		 */
		public function countTasksOpened( Project $project )
		{
				$count = 0;
				foreach ( $project->tasks as $t ):
						if ( $t->status == "1" ):
								$count++;
						endif;
				endforeach;
				return $count;
		}
}