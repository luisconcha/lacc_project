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
						'name'       => 'required',
						'project_id' => 'required|integer',
						'start_date' => 'required|date|after:now',
						'due_date'   => 'required|date|after:start_date',
						'status'     => 'required|integer|max:1',
				],

				ValidatorInterface::RULE_UPDATE => [
						'name'        => 'sometimes|required',
						'project_id ' => 'sometimes|required|integer',
						'start_date'  => 'sometimes|required|date',
						'due_date'    => 'sometimes|required|date|after:start_date',
						'status'      => 'sometimes|required|max:1',
				],
		];
}