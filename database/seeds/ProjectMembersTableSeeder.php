<?php

use Illuminate\Database\Seeder;

class ProjectMembersTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				//\LACC\Entities\ProjectMembers::truncate();
				factory( \LACC\Entities\ProjectMembers::class, 10 )->create();
		}
}
