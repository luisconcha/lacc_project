<?php
/**
 * File: ClientTransformer.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 05/03/16
 * Time: 23:16
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Transformers;

use League\Fractal\TransformerAbstract;
use LACC\Entities\Client;

class ClientTransformer extends TransformerAbstract
{
		protected $defaultIncludes = [ 'projects' ];

		public function transform( Client $client )
		{
				return [
						'id'          => (int)$client->id,
						'name'        => $client->name,
						'responsible' => $client->responsible,
						'email'       => $client->email,
						'phone'       => $client->phone,
						'address'     => $client->address,
						'obs'         => $client->obs,
				];
		}

		public function includeProjects( Client $client )
		{
				$transformer = new ProjectTransformer();
				$transformer->setDefaultIncludes( [ ] );
				return $this->collection( $client->projects, $transformer );
		}
}
