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

use Illuminate\Database\Eloquent\ModelNotFoundException;
use LACC\Repositories\ProjectRepository;
use LACC\Validators\ProjectValidator;

class ProjectService extends BaseService
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

		public function addMember( $idProject, $idUser )
		{
				try {
						$this->repository->find( $idProject )->members()->attach( $idUser );
						return response()->json( [
								'success' => true,
								'message' => "O membrom com ID {$idUser} foi add com sucesso!",
						] );
				} catch ( \Exception $e ) {
						return [
								'success' => false,
								'data'    => "Membro com ID: {$idUser} não localizado na base de dados",
						];
				}
		}

		public function showMembers( $idProject )
		{
				try {
						return response()->json( [
								$this->repository->find( $idProject )->members->all(),
						] );
				} catch ( \Exception $e ) {
						return response()->json( [
								'success' => false,
								'message' => 'Error: ' . $e->getMessage() ] );
				}
		}

		public function removeMember( $idProject, $userId )
		{
				try {
						return response()->json( [
								$this->repository->find( $idProject )->members()->detach($userId),
						] );
				} catch ( \Exception $e ) {
						return response()->json( [
								'success' => false,
								'message' => 'Error: ' . $e->getMessage() ] );
				}
		}
}