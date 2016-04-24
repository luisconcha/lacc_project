<?php

namespace LACC\Transformers;

use LACC\Entities\Project;
use LACC\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;


/**
 * Class ProjectNoteTransformer
 * @package namespace LACC\Transformers;
 */
class ProjectNoteTransformer extends TransformerAbstract
{
		protected $availableIncludes = [
				'project',
		];

		/**
		 * Transform the \ProjectTask entity
		 *
		 * @param \ProjectNote $model
		 *
		 * @return array
		 */
		public function transform( ProjectNote $data )
		{
				return [
						'id'             => (int)$data->id,
						'title'          => $data->title,
						'note'           => $data->note,
						'data_criacao'   => $data->created_at,
						'data_alteracao' => $data->updated_at,
						'project_id'     => (int)$data->project_id,
						'project_name'   => $data->project->name,
				];
		}

		public function includeProject( Project $project )
		{
				return $this->collection( $project->project, new ProjectMemberTransformer() );
		}
}
