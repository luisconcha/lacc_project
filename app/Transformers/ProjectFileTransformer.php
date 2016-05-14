<?php
/**
 * File: ProjectFileTransformer.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 05/03/16
 * Time: 23:16
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Transformers;

use LACC\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract
{
		public function transform( ProjectFile $p )
		{
				return [
						'id'           => $p->id,
						'name'         => $p->name,
						'extension'    => $p->extension,
						'description'  => $p->description,
						'project_id'   => $p->project_id,
						'project_name' => $p->project->name,
				];
		}
}