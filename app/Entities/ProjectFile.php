<?php
/**
 * File: ProjectFile.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 22/02/16
 * Time: 18:31
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class ProjectFile extends Model implements Transformable
{
		use TransformableTrait;
		protected $fillable = [
				'name',
				'project_id',
				'description',
				'extension',
		];

		public function project()
		{
				return $this->belongsTo( Project::class );
		}
}
