<?php
/**
 * File: UserPresenter.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 20/04/16
 * Time: 21:30
 * Project: estudo_laravel
 * Copyright: 2016
 */

namespace LACC\Presenters;

use LACC\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class UserPresenter extends FractalPresenter
{
        /**
         * Transformer
         *
         * @return \League\Fractal\TransformerAbstract
         */
        public function getTransformer()
        {
                return new UserTransformer();
        }
}