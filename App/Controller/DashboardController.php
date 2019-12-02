<?php

/*
 * This file is part of the leviframework to projetc git-hub-api.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */


 /*
  * Set PHP heavily typed
  */
declare(strict_types=1);
namespace App\Controller;

use App\Controller\GitHubController;
use App\Model\Repositories as RepositoriesModel;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Controller.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class DashboardController extends Controller
{

	/**
     * @var ResponseInterface
     */
	private $response;

	/**
     * @var String
     */
	private $access_token;

	/**
     * @var Class Model
     */
	private $git_hub_controller;

	/**
     * @var String
     */
	private $state;

	/**
     * @var String
     */
	private $code;

	/**
     * @var String
     */
	private $user_data;

	private $repositories_model;

	public function __construct(ResponseInterface $response)
	{
		parent::__construct();
		$this->response = $response;
		$this->git_hub_controller = new GitHubController;
		$this->access_token = getSession('access_token');
		$this->state = getSession('state');
		$this->code = getSession('code');
		$this->user_data = getSession('user_data');
		$this->repositories_model = new RepositoriesModel;

		if(!$this->user_data or $this->user_data == "")
			return redirect('');
	}

	/**
	 * show view index dashboard
	 * @param void
	 * @return View
	*/
	public function index()
	{
		$repos = $this->git_hub_controller->getUserRepos($this->access_token);
		return view('auth.dashboard.index', [
			'user_data' => $this->user_data,
			'repos' => $repos,
		]);
	}

	/**
	 * Show request detail view and list all repos searchied
	 * @param $request
	 * @return View
	*/
	public function search($request)
	{
		$request = (object) $request->getQueryParams();
		$search_term = $request->q;
		$search_result = new \stdClass;
		$user_data = $this->git_hub_controller->getUserData($this->access_token);

		for($i = 0; $i < 5; $i++) {
			$language = '';

			if($i == 0)
				$language = 'php';
			elseif($i == 1)
				$language = 'java';
			elseif($i == 2)
				$language = 'javascript';
			elseif($i == 3)
				$language = 'C';
			elseif($i == 4)
				$language = 'c++';

			$search_result->{$i} = $this->git_hub_controller->searchRepo('https://api.github.com/search/repositories', $this->access_token, $search_term, $language);
			$search_result->{$i}->language = $language;

			foreach($search_result->{$i}->items as $item) {
				$get_repository_by_url = $this->repositories_model->getRepositorieByUrl(base64_encode($item->url));
				
				if(!$get_repository_by_url)
					$this->repositories_model->saveRespoitorie($item->name, base64_encode($item->url), $item->private ? 'private' : 'public', $language, isset($item->descitption) ? $item->descitption : 'Not Description');
			}
		}

		//first convert object result form search to array
		$search_result_to_array = (array) $search_result;

		//after converted suffle values into array to best experience
		shuffle($search_result_to_array);

		//and convert array to object again
		$search_result_to_object = (object) $search_result_to_array;

		return view('auth.search.result', [
			'search_result' => $search_result_to_object,
			'user_data' => $this->user_data,
			'search_term' => $search_term,
		]);
	}
}