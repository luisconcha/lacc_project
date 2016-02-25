<?php
/**
 * File: ClientService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 21/02/16
 * Time: 17:10
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Services;

use LACC\Repositories\ClientRepository;
use LACC\Validators\ClientValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService extends BaseService
{
		/**
		 * @var ClientRepository
		 */
		protected $repository;
		/**
		 * @var ClientValidator
		 */
		protected $validator;

		public function __construct( ClientRepository $repository, ClientValidator $validator )
		{
				$this->repository = $repository;
				$this->validator  = $validator;
		}

}