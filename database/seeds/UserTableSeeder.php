<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				//\LACC\Entities\User::truncate();

				factory( 'LACC\Entities\User' )->create(
						[
								'name'           => 'Luis Alberto Concha Curay',
								'email'          => 'luvett11@gmail.com',
								'password'       => bcrypt( '123456' ),
								'remember_token' => str_random( 10 ),
						]
				);

				factory(\LACC\Entities\User::class, 2)->create();
		}
}
