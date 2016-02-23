<?php
/**
 * File: Project.php
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

class Project extends Model
{
		protected $fillable = [
				'owner_id',
				'client_id',
				'name',
				'description',
				'progress',
				'status',
				'due_date',
		];

		public function owner()
		{
				return $this->belongsTo( User::class );
		}

		public function client()
		{
				return $this->belongsTo( Client::class );
		}
}
