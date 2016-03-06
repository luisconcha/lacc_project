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
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
		use TransformableTrait;
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
				return $this->belongsTo( User::class, 'owner_id' );
		}

		public function client()
		{
				return $this->belongsTo( Client::class );
		}

		public function notes()
		{
				return $this->hasMany( ProjectNote::class );
		}

		public function tasks()
		{
				return $this->hasMany( ProjectTask::class );
		}

		public function members()
		{
				return $this->belongsToMany( User::class, 'project_members', 'project_id', 'user_id' );
		}

		public function files()
		{
				return $this->hasMany( ProjectFile::class );
		}
}
