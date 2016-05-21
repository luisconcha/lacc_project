<?php

namespace LACC\Transformers;

use League\Fractal\TransformerAbstract;
use LACC\Entities\Project;
use LACC\Entities\ProjectTask;

/**
 * Class ProjectTaskTransformer
 * @package namespace LACC\Transformers;
 */
class ProjectTaskTransformer extends TransformerAbstract
{
		protected $defaultIncludes = [ ];

		/**
		 * Transform the \ProjectTask entity
		 *
		 * @param \ProjectTask $model
		 *
		 * @return array
		 */
		public function transform( ProjectTask $data )
		{
				return [
						'id'           => (int)$data->id,
						'name'         => $data->name,
						'project'      => $data->project_id,
						'project_name' => $data->name,
						'start_date'   => $data->start_date,
						'due_date'     => $data->due_date,
						'status'       => $data->status,
				];
		}

		public function includeProjects( Project $project )
		{
				return $this->collection( $project->tasks(), new ProjectTaskTransformer() );
		}
}
