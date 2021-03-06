<?php

namespace LACC\Http\Middleware;

use Closure;
use LACC\Services\ProjectService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class CheckProjectOwner
{
		/**
		 * @var ProjectService
		 */
		protected $service;

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
				 * Verifica se existe na rota o parametro de nome: projectId (routes.php)
				 * caso não exista, coloca como default o prefix: projects
				 */
				$projectId = $request->route( 'id' ) ? $request->route( 'id' ) : $request->route( 'projects' );

				if ( $this->service->checkProjectOwner( $projectId ) == false ):
						return [ 'access' => 'Access forbidden' ];
				endif;

				return $next( $request );
		}
}
