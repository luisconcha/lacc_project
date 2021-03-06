<?php
/**
 * File: ProjectPresenter.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 05/03/16
 * Time: 23:24
 * Project: lacc_project
 * Copyright: 2016
 */

namespace LACC\Presenters;

use LACC\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends FractalPresenter
{
		public function getTransformer()
		{
				return new ProjectTransformer();
		}
}