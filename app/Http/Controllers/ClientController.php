<?php
/**
 * File: ClientController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 21/02/16
 * Time: 12:37
 * Project: lacc_project
 * Copyright: 2016
 *
 */

namespace LACC\Http\Controllers;

use Illuminate\Http\Request;

use LACC\Http\Requests;
use LACC\Repositories\ClientRepository;

class ClientController extends Controller
{
		/**
		 * @var ClientRepository
		 */
		private $repository;

		public function __construct( ClientRepository $repository )
		{
				$this->repository = $repository;
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
				return $this->repository->all();
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store( Request $request )
		{
				return $this->repository->create( $request->all() );
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show( $id )
		{
				return $this->repository->find( $id );
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( Request $request, $id )
		{
				$this->repository->find( $id )->update( $request->all() );
				return response()->json( [ 'message' => 'Cliente atualizado com sucesso!' ] );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( $id )
		{
				$this->repository->find( $id )->delete();
				return response()->json( [ 'message' => 'Cliente deletado com sucesso!' ] );
		}
}
