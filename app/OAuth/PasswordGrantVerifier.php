<?php
/**
 * File: PasswordGrantVerifier.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 05/03/16
 * Time: 18:18
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\OAuth;


use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
		public function verify( $username, $password )
		{
				$credentials = [
						'email'    => $username,
						'password' => $password,
				];

				if ( Auth::once( $credentials ) ) {
						return Auth::user()->id;
				}

				return false;
		}
}