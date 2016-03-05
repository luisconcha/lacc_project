<?php
/**
 * File: OAuthClients.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 05/03/16
 * Time: 20:40
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OAuthClients extends Model implements Transformable
{
		use TransformableTrait;

		protected $table =  'oauth_clients';

		protected $fillable = [
				'id',
				'secret',
				'name',
				'created_at',
				'update_at',
		];
}
