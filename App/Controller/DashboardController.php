<?php

/*
 * This file is part of the leviframework to projetc webjump.
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

	private $access_token;

	private $git_hub_controller;

	private $state;

	private $code;

	public function __construct(ResponseInterface $response)
	{
		parent::__construct();
		$this->response = $response;
		$this->git_hub_controller = new GitHubController;
		$this->access_token = getSession('access_token');
		$this->state = getSession('state');
		$this->code = getSession('code');	
	}

	public function index()
	{
		$user_data = $this->git_hub_controller->getUserData($this->access_token);
		$repos = $this->git_hub_controller->getUserRepos($this->access_token);

		return view('auth.dashboard.index', [
			'user_data' => $user_data,
			'repos' => $repos,
		]);
	}

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
		}

		//first convert object result form search to array
		$search_result_to_array = (array) $search_result;

		//after converted suffle values into array to best experience
		shuffle($search_result_to_array);

		//and convert array to object again
		$search_result_to_object = (object) $search_result_to_array;

		return view('auth.search.result', [
			'search_result' => $search_result_to_object,
			'user_data' => $user_data,
			'search_term' => $search_term,
		]);
	}
}