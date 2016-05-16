<?php

namespace LACC\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
		protected $rules = [
				ValidatorInterface::RULE_CREATE => [
						'file'       => 'required|mimes:doc,docx,jpg,jpeg,pdf,gif,pdf,zip',
						'name'       => 'required',
						'extension'  => 'required',
				],

				ValidatorInterface::RULE_UPDATE => [
						'file'       => 'sometimes|required|mimes:doc,docx,jpg,jpeg,pdf,gif,pdf,zip',
						'name'       => 'sometimes|required',
						'extension'  => 'sometimes|required',
				],
		];
}