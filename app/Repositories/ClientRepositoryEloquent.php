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
		//@seed: https://github.com/andersao/l5-repository#create-a-criteria
		protected $fieldSearchable = [
				'name'
		];

		public function model()
		{
				return Client::class;
		}

		public function presenter()
		{
				return ClientPresenter::class;
		}

		/**
		 * Metodo para fazer pesquisa por algum campo especifico, see: protected $fieldSearchable
		 * @seed: https://github.com/andersao/l5-repository#create-a-criteria
		 */
		public function boot()
		{
				$this->pushCriteria( app( 'Prettus\Repository\Criteria\RequestCriteria' ) );
		}
}