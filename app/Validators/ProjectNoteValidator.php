<?php
/**
 * File: ProjectNoteValidator.php
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

class ProjectNoteValidator extends LaravelValidator
{
		protected $rules = [
				ValidatorInterface::RULE_CREATE => [
						'title'      => 'required',
						'note'       => 'required',
				],

				ValidatorInterface::RULE_UPDATE => [
						'title'       => 'sometimes|required',
						'note'        => 'sometimes|required',
				],
		];
}