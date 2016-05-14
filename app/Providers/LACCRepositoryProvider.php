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

				$this->app->bind(
						\LACC\Repositories\ProjectRepository::class,
						\LACC\Repositories\ProjectRepositoryEloquent::class
				);

				$this->app->bind(
						\LACC\Repositories\ProjectNoteRepository::class,
						\LACC\Repositories\ProjectNoteRepositoryEloquent::class
				);

				$this->app->bind(
						\LACC\Repositories\ProjectTaskRepository::class,
						\LACC\Repositories\ProjectTaskRepositoryEloquent::class
				);

				$this->app->bind(
						\LACC\Repositories\ProjectMembersRepository::class,
						\LACC\Repositories\ProjectMembersRepositoryEloquent::class
				);
				
				$this->app->bind(
						\LACC\Repositories\UserRepository::class,
						\LACC\Repositories\UserRepositoryEloquent::class
				);

				$this->app->bind(
						\LACC\Repositories\ProjectFileRepository::class,
						\LACC\Repositories\ProjectFileRepositoryEloquent::class
				);
		}
}
