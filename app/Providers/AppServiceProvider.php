<?php

namespace LACC\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use LACC\Entities\ProjectTask;
use LACC\Events\TaskWasIncluded;

class AppServiceProvider extends ServiceProvider
{
		/**
		 * Bootstrap any application services.
		 *
		 * @return void
		 */
		public function boot()
		{		
				/**
				* Verifica se a aplicaçao esta rodando em modo console (para rodar as seeds), 
				* para evitar executar os eventos
				*/
				if ( app()->runningInConsole() ) {
		           return;
		        }

				ProjectTask::created( function ( $task ) {
						Event::fire( new TaskWasIncluded( $task ) );
				} );

				ProjectTask::updated( function ( $task ) {
						Event::fire( new TaskWasIncluded( $task ) );
				} );
		}

		/**
		 * Register any application services.
		 *
		 * @return void
		 */
		public function register()
		{
				//
		}
}
