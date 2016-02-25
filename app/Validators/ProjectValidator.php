<?php
/**
 * File: ProjectValidator.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 24/02/16
 * Time: 21:18
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
		protected $rules = [
				ValidatorInterface::RULE_CREATE => [
						'owner_id'    => 'required|integer',
						'client_id'   => 'required|integer',
						'name'        => 'required',
						'description' => 'required',
						'progress'    => 'required|min:0|max:3',
						'status'      => 'required|min:0|max:1',
						'due_date'    => 'required|date',
				],

				ValidatorInterface::RULE_UPDATE => [
						'owner_id'    => 'sometimes|required|integer',
						'client_id'   => 'sometimes|required|integer',
						'name'        => 'sometimes|required',
						'description' => 'sometimes|required',
						'progress'    => 'sometimes|required|min:0|max:3',
						'status'      => 'sometimes|required|min:0|max:1',
						'due_date'    => 'sometimes|required|date',
				],
		];
}