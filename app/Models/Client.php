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

namespace LACC\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
		protected $fillable = [
				'name',
				'responsible',
				'email',
				'phone',
				'address',
				'obs'
		];
}
