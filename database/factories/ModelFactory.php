<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define( LACC\Entities\User::class, function ( Faker\Generator $faker ) {
		return [
				'name'           => $faker->name,
				'email'          => $faker->email,
				'password'       => bcrypt( str_random( 10 ) ),
				'remember_token' => str_random( 10 ),
		];
} );

$factory->define( LACC\Entities\Client::class, function ( Faker\Generator $faker ) {
		return [
				'name'        => $faker->name,
				'responsible' => $faker->name,
				'email'       => $faker->email,
				'phone'       => $faker->phoneNumber,
				'address'     => $faker->address,
				'obs'         => $faker->sentence(),
		];
} );

$factory->define( LACC\Entities\Project::class, function ( Faker\Generator $faker ) {
		return [
				'owner_id'    => $faker->numberBetween( 1, 3 ),
				'client_id'   => $faker->numberBetween( 1, 10 ),
				'name'        => $faker->word,
				'description' => $faker->paragraph(),
				'progress'    => $faker->numberBetween( 0, 100 ),
				'status'      => $faker->numberBetween( 0, 2 ),
				'due_date'    => $faker->dateTimeBetween( 'tomorrow', '+1 year' ),
		];
} );

$factory->define( LACC\Entities\ProjectNote::class, function ( Faker\Generator $faker ) {
		return [
				'project_id' => $faker->numberBetween( 1, 10 ),
				'title'      => $faker->word(),
				'note'       => $faker->paragraph(),
		];
} );