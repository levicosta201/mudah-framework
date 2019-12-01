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

	private $git_hub_controller;

	public function __construct(ResponseInterface $response)
	{
		parent::__construct();
		$this->response = $response;
		$this->git_hub_controller = new GitHubController;
	}

	public function index()
	{
		$state = getSession('state');
		$code = getSession('code');
		$access_token = getSession('access_token');

		$user_data = $this->git_hub_controller->getUserData($access_token);
		$repos = $this->git_hub_controller->getUserRepos($access_token);

		return view('dashboard.index', [
			'user_data' => $user_data,
			'repos' => $repos,
		]);
	}
}