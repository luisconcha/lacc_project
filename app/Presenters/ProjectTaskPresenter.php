<?php

namespace LACC\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use LACC\Transformers\ProjectTaskTransformer;

/**
 * Class ProjectTaskPresenter
 *
 * @package namespace LACC\Presenters;
 */
class ProjectTaskPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectTaskTransformer();
    }
}
