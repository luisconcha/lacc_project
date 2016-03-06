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
		public function transform( Client $client )
		{
				return [
						'id'          => $client->id,
						'name'        => $client->name,
				];
		}
}
