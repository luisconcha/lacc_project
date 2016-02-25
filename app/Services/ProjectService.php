<?php
/**
 * File: ProjectService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 24/02/16
 * Time: 20:55
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Services;


use Illuminate\Contracts\Validation\ValidationException;
use LACC\Repositories\ProjectRepository;
use LACC\Validators\ProjectValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
		/**
		 * @var ProjectRepository
		 */
		protected $repository;
		/**
		 * @var ProjectValidator
		 */
		protected $validator;

		public function __construct( ProjectRepository $repository, ProjectValidator $validator )
		{
				$this->repository = $repository;
				$this->validator  = $validator;
		}

		public function all()
		{
				return response()->json( $this->repository->with( [
						'owner',
						'client',
				] )->all() );

		}

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
								'data'    => "Projecto com ID: {$id} não localizado na base de dados",
						];
				}
		}
}