<?php
/**
 * File: ProjectNoteService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 24/02/16
 * Time: 20:55
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Services;

use LACC\Repositories\ProjectNoteRepository;
use LACC\Validators\ProjectNoteValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class ProjectNoteService extends BaseService
{
		/**
		 * @var ProjectNoteRepository
		 */
		protected $repository;
		/**
		 * @var ProjectNoteValidator
		 */
		protected $validator;

		public function __construct( ProjectNoteRepository $repository, ProjectNoteValidator $validator )
		{
				$this->repository = $repository;
				$this->validator  = $validator;
		}

		public function all( $projectId, $limit )
		{
				return $this->repository->findNoteByProject( $projectId, $limit );

				//Retorna a consulta utilizando presenter
				//return response()->json( $this->repository->with( [ 'project' ] )->paginate(1)
				//			->where( [ 'project_id' => $id ] ) );

				//skipPresenter faz a consulta não utilizando o presenter
				//return response()->json( $this->repository->skipPresenter()
				//		->with( [ 'project' ] )
				//		->findWhere( [ 'project_id' => $id ] ) );
		}

		public function update( array $data, $noteId )
		{
				try {

						$this->validator->with( $data )->setId( $noteId )->passesOrFail( ValidatorInterface::RULE_UPDATE );

						return $this->repository->update( $data, $noteId );

				} catch ( ValidationException $e ) {
						return response()->json( [
								'error'   => true,
								'message' => $e->getMessage(),
						] );
				}
		}

		public function searchNoteById( $noteId )
		{
				try {
						return response()->json(
								$this->repository->with( [ 'project' ] )
										->find( $noteId )
						);
				} catch ( \Exception $e ) {
						return [
								'success' => false,
								'data'    => "Dado com ID: {$noteId} não localizado na base de dados",
						];
				}
		}
}