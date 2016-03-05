<?php

use Illuminate\Database\Seeder;

class OAuthClientsTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				factory( 'LACC\Entities\OAuthClients' )->create(
						[
								'id'        => 'appid1',
								'secret'    => bcrypt( '123456' ),
								'name'      => 'AngularApp',
								'created_at' => date( 'Y-m-d H:i:s' ),
						]
				);

				factory( 'LACC\Entities\OAuthClients' )->create(
						[
								'id'        => 'appid2',
								'secret'    => bcrypt( '1234567' ),
								'name'      => 'LaravelApp',
								'created_at' => date( 'Y-m-d H:i:s' ),
						]
				);

				factory( 'LACC\Entities\OAuthClients' )->create(
						[
								'id'        => 'appid3',
								'secret'    => bcrypt( '12345678' ),
								'name'      => 'mysqlApp',
								'created_at' => date( 'Y-m-d H:i:s' ),
						]
				);

		}
}
