<?php
/**
 * File: CheckProjectPermission.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 14/05/16
 * Time: 21:11
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Http\Middleware;

use Closure;
use LACC\Services\ProjectService;

class CheckProjectPermission
{
		/**
		 * @var ProjectService
		 */
		private $service;

		/**
		 * @param ProjectService $service
		 */
		public function __construct( ProjectService $service )
		{
				$this->service = $service;
		}

		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \Closure $next
		 *
		 * @return mixed
		 */
		public function handle( $request, Closure $next )
		{
				/**
				 * Verifica se existe na rota o parametro de nome: id (routes.php)
				 * caso não exista, coloca como default o prefix: projects
				 */
				$projectId = $request->route( 'id' ) ? $request->route( 'id' ) : $request->route( 'projects' );

				if ( $this->service->checkProjectPermissions( $projectId ) == false ):
						return [ 'access' => 'You haven\'t permission to access project' ];
				endif;

				return $next( $request );
		}
}