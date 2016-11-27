<?php
/**
 * File: ReportsController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 27/11/16
 * Time: 00:26
 * Project: lacc_project
 * Copyright: 2016
 */
namespace LACC\Http\Controllers;

use LACC\Repositories\ProjectRepository;

class ReportsController extends Controller
{
		/**
		 * @var ProjectRepository
		 */
		protected $projectRepository;

		public function __construct( ProjectRepository $projectRepository )
		{
				$this->projectRepository = $projectRepository;
		}

		public function index()
		{
				return $this->projectRepository->skipPresenter( false )->all();
		}

}