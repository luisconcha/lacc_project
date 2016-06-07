<?php
/**
 * File: OauthExceptionMiddleware.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 07/06/16
 * Time: 18:30
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Http\Middleware;

use Closure;
use League\OAuth2\Server\Exception\OAuthException;

class OauthExceptionMiddleware
{
		public function handle( $request, Closure $next )
		{
				try {
						$response = $next( $request );
						// Foi uma exceção lançada ? É capturada e disponível em nosso middleware
						if ( isset( $response->exception ) && $response->exception ) {
								throw $response->exception;
						}

						return $response;

				} catch ( OAuthException $e ) {
						$data = [
//                'error' => $e->errorType,
//                'error_description' => $e->getMessage(),
								'error'             => $e->errorType,
								'title_message'     => 'Credenciais inválidas',
								'error_description' => 'Usuário ou senha não são válidas, favor tente novamente',
						];
						return \Response::json( $data, $e->httpStatusCode, $e->getHttpHeaders() );
				}
		}
}