<?php
/**
 * File: ClientValidator.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 21/02/16
 * Time: 17:21
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
		protected $rules = [
				ValidatorInterface::RULE_CREATE => [
						'name'        => 'required|max:255',
						'responsible' => 'required|max:255',
						'email'       => 'required|email|unique:clients',
						'phone'       => 'required',
						'address'     => 'required',
				],
				ValidatorInterface::RULE_UPDATE => [
						'name'        => 'sometimes|required|max:255',
						'responsible' => 'sometimes|required|max:255',
						'email'       => 'sometimes|required|email|unique:clients',
						'phone'       => 'sometimes|required',
						'address'     => 'sometimes|required',
				],
		];
}