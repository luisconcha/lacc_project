<?php

namespace LACC\Presenters;

use LACC\Transformers\ClientTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ClientPresenter
 *
 * @package namespace LACC\Presenters;
 */
class ClientPresenter extends FractalPresenter
{
		/**
		 * Transformer
		 *
		 * @return \League\Fractal\TransformerAbstract
		 */
		public function getTransformer()
		{
				return new ClientTransformer();
		}
}
