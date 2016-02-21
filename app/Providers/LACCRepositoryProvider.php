<?php

namespace LACC\Providers;

use Illuminate\Support\ServiceProvider;

class LACCRepositoryProvider extends ServiceProvider
{
		/**
		 * Bootstrap the application services.
		 *
		 * @return void
		 */
		public function boot()
		{
				//
		}

		/**
		 * Register the application services.
		 *
		 * @return void
		 */
		public function register()
		{
				$this->app->bind(
						\LACC\Repositories\ClientRepository::class,
						\LACC\Repositories\ClientRepositoryEloquent::class
				);

		}
}
