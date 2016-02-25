<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
		/**
		 * A basic functional test example.
		 *
		 * @return void
		 */
		public function testBasicExample()
		{
				$this->visit( '/' )
						->see( 'Laravel 5' );
		}

		public function testOlaMundo()
		{
				$this->visit( '/ola' )
						->see( 'Olá mundo!' );
		}

		public function testPostRoute()
		{
				$this->post( '/post', [
						'name'  => 'Luis Alberto',
						'idade' => '23',
						'email' => 'luvett1@gmal.com'
				] )->seeStatusCode( 200 )
					 ->seeJson([
							 'name'  => 'Luis Alberto',
							 'idade' => '23',
							 'email' => 'luvett1@gmal.com'
					 ]);
		}
}
