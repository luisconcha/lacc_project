<?php

namespace LACC\Http\Middleware;

use Closure;
use LACC\Repositories\ProjectRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class CheckProjectOwner
{
		/**
		 * @var ProjectRepository
		 */
		protected $repository;

		public function __construct( ProjectRepository $repository )
		{
				$this->repository = $repository;
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
				$userId    = Authorizer::getResourceOwnerId();
				$idProject = $request->id;

				if ( $this->repository->isOwner( $idProject, $userId ) == false ):
						return [ 'access' => 'Access forbidden' ];
				endif;

				return $next( $request );
		}
}
