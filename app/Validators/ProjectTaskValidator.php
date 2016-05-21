<?php
/**
 * File: ProjectTaskValidator.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 27/02/16
 * Time: 14:48
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
		protected $rules = [
				ValidatorInterface::RULE_CREATE => [
						'name' => 'required',
				],

				ValidatorInterface::RULE_UPDATE => [
						'name' => 'sometimes|required',
				],
		];
}