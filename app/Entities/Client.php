<?php
/**
 * File: Client.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 21/02/16
 * Time: 12:37
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Client extends Model implements Transformable
{
		use TransformableTrait;

		protected $fillable = [
				'name',
				'responsible',
				'email',
				'phone',
				'address',
				'obs',
		];

		public function projects()
		{
				return $this->hasMany( Project::class );
		}
}
