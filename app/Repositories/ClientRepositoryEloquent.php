<?php
/**
 * File: ClientRepositoryEloquent.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 21/02/16
 * Time: 16:20
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Repositories;

use LACC\Entities\Client;
use LACC\Presenters\ClientPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
		public function model()
		{
				return Client::class;
		}

		public function presenter()
		{
				return ClientPresenter::class;
		}
}