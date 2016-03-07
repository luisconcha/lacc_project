<?php

namespace LACC\Presenters;

use LACC\Transformers\ProjectNoteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProjectNotePresenter
 *
 * @package namespace LACC\Presenters;
 */
class ProjectNotePresenter extends FractalPresenter
{
		/**
		 * Transformer
		 *
		 * @return \League\Fractal\TransformerAbstract
		 */
		public function getTransformer()
		{
				return new ProjectNoteTransformer();
		}
}
