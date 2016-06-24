<?php
/**
 * File: TaskWasIncluded.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 23/06/16
 * Time: 22:53
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Events;


use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use LACC\Entities\ProjectTask;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class TaskWasIncluded extends Event implements ShouldBroadcast
{
		use SerializesModels;

		public $task;

		public function __construct( ProjectTask $task )
		{
				$this->task = $task;
		}

		/**
		 * Get the channels the event should broadcast on.
		 *
		 * @return array
		 */
		public function broadcastOn()
		{
				return [
						'user.' . Authorizer::getResourceOwnerId(),
				];
		}
}