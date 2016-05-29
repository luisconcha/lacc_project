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
use LACC\Services\ClientService;

class ClientController extends Controller
{
		/**
		 * @var ClientRepository
		 */
		private $repository;
		/**
		 * @var ClientService
		 */
		private $service;

		public function __construct( ClientRepository $repository, ClientService $service )
		{
				$this->repository = $repository;
				$this->service    = $service;
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index( Request $request )
		{
				$limit = $request->query->get( 'limit',15 );
				return $this->repository->paginate( $limit );
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
				return $this->service->create( $request->all() );
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
				return $this->service->searchById( $id );
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
				return $this->service->update( $request->all(), $id );
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
				try {
						$dataClient = $this->service->searchById( $id );
						if ( $dataClient ) {
								if ( $this->repository->delete( $id ) ) {
										return response()->json( [ 'success' => 'O Cliente foi deletado com sucesso!' ] );
								}
						}
				} catch ( \Exception $e ) {
						return response()->json( [ 'message' => $e->getMessage() ] );
				}
		}
}
