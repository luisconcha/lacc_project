<?php

namespace LACC\Repositories;

use LACC\Entities\User;
use LACC\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LACC\Repositories\UserRepositoryRepository;
use LACC\Validators\UserRepositoryValidator;

/**
 * Class UserRepositoryRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
        /**
         * Specify Model class name
         *
         * @return string
         */
        public function model()
        {
                return User::class;
        }

        /**
         * Boot up the repository, pushing criteria
         */
        public function boot()
        {
                $this->pushCriteria( app( RequestCriteria::class ) );
        }

        public function presenter()
        {
                return UserPresenter::class;
        }
}
