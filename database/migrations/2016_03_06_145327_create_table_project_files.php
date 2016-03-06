<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjectFiles extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create( 'project_files', function ( Blueprint $table ) {
						$table->increments( 'id' );
						$table->string( 'name' );
						$table->integer( 'project_id' )->unsigned();
						$table->foreign( 'project_id' )->references( 'id' )->on( 'projects' );
						$table->text( 'description' );
						$table->string( 'extension', 5 );
						$table->timestamps();
				} );
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
				Schema::drop( 'project_files' );
		}
}
