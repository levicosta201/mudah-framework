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
class RepositorieController extends Controller
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

	public function detail($request)
	{
		$request = (object) $request->getQueryParams();
		
		$state = getSession('state');
		$code = getSession('code');
		$access_token = getSession('access_token');
		$repo = base64_decode($request->repo);

		$user_data = $this->git_hub_controller->getUserData($access_token);
		$repo_detail = $this->git_hub_controller->getRepoDetail($repo, $access_token);
		$get_branches_url = str_replace('{/branch}', '', $repo_detail->branches_url);
		$repo_branches = $this->git_hub_controller->getRepoBranche($get_branches_url, $access_token);

		return view('auth.repositorie.detail', [
			'user_data' => $user_data,
			'repo_detail' => $repo_detail,
			'repo_branches' => $repo_branches,
		]);
	}
}