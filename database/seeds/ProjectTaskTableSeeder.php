<?php

use Illuminate\Database\Seeder;

class ProjectTaskTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				//\LACC\Entities\ProjectTask::truncate();
				factory( \LACC\Entities\ProjectTask::class, 30 )->create();
		}
}
