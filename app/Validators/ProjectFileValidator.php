<?php

namespace LACC\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
		protected $rules = [
				'file'       => 'required|mimes:doc,docx,jpg,jpeg,pdf',
				'name'       => 'required',
				'extension'  => 'required',
				'project_id' => 'required',
		];
}