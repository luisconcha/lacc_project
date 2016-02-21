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

class ClientService
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

		public function create( array $data )
		{
				try {
						$this->validator->with( $data )->passesOrFail(ValidatorInterface::RULE_CREATE);
						return $this->repository->create( $data );
				} catch ( ValidatorException $e ) {
						return [
								'error'   => true,
								'message' => $e->getMessageBag(),
						];
				}
		}

		public function update( array $data, $id )
		{
				try {
						$this->validator->with( $data )->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
						return response()->json( $this->repository->update( $data, $id ) );
				} catch ( ValidatorException $e ) {
						return response()->json( [
								'error'   => true,
								'message' => $e->getMessageBag(),
						], 412 );
				}
		}

		public function searchById( $id )
		{
				try {
						return [
								'success' => true,
								'data'    => $this->repository->find( $id ),
						];
				} catch ( \Exception $e ) {
						return [
								'success' => false,
								'data'    => "Cliente com ID {$id} no encontrado",
						];
				}
		}
}