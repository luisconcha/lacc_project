<?php

namespace LACC\Transformers;

use LACC\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;


/**
 * Class ProjectNoteTransformer
 * @package namespace LACC\Transformers;
 */
class ProjectNoteTransformer extends TransformerAbstract
{
		protected $defaultIncludes = [ ];

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
						'id'         => (int)$data->id,
						'project_id' => (int)$data->project_id,
						'title'      => $data->title,
						'note'       => $data->note,
				];
		}
}
