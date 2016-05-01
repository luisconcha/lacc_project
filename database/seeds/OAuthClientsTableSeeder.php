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
								'secret'    => 'secret',
								'name'      => 'AngularApp',
								'created_at' => date( 'Y-m-d H:i:s' ),
						]
				);

				factory( 'LACC\Entities\OAuthClients' )->create(
						[
								'id'        => 'appid2',
								'secret'    => 'secret',
								'name'      => 'LaravelApp',
								'created_at' => date( 'Y-m-d H:i:s' ),
						]
				);

				factory( 'LACC\Entities\OAuthClients' )->create(
						[
								'id'        => 'appid3',
								'secret'    => 'secret',
								'name'      => 'mysqlApp',
								'created_at' => date( 'Y-m-d H:i:s' ),
						]
				);

		}
}
