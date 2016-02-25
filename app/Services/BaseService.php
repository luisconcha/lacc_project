<?php
/**
 * File: BaseService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 24/02/16
 * Time: 23:10
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Services;


use Illuminate\Contracts\Validation\ValidationException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class BaseService
{

		public function create( array $data )
		{
				try {
						$this->validator->with( $data )->passesOrFail( ValidatorInterface::RULE_CREATE );
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

						$this->validator->with( $data )->setId( $id )->passesOrFail( ValidatorInterface::RULE_UPDATE );

						return response()->json( [
								$this->repository->update( $data, $id ),
						] );
				} catch ( ValidationException $e ) {
						return response()->json( [
								'error'   => true,
								'message' => $e->getMessage(),
						] );
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
								'data'    => "Dado com ID: {$id} não localizado na base de dados",
						];
				}
		}
}