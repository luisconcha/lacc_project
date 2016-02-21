<?php

/**
 * File: ClientTableSeeder.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 21/02/16
 * Time: 12:37
 * Project: lacc_project
 * Copyright: 2016
 *
 */

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				\LACC\Entities\Client::truncate();
				factory( \LACC\Entities\Client::class, 10 )->create();
		}
}
