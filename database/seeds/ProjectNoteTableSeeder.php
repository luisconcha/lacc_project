<?php

use Illuminate\Database\Seeder;

class ProjectNoteTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				//\LACC\Entities\ProjectNote::truncate();
				factory( \LACC\Entities\ProjectNote::class, 50 )->create();
		}
}
