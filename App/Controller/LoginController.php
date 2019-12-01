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
use App\Dao\User as UserDao;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Controller.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class LoginController extends Controller
{

	/**
     * @var ResponseInterface
     */
	private $response;

	private $git_hub_controller;
	private $user_dao;

	public function __construct(ResponseInterface $response)
	{
		parent::__construct();
		$this->response = $response;
		$this->git_hub_controller = new GitHubController;
		$this->user_dao = new UserDao;
	}

	public function index()
	{
		$security_hash = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);

		if(!getSession('user_data') or isset($access_token->error))
			return view('auth.login', [
				'url_o_auth' => htmlspecialchars($this->git_hub_controller->getAuthorizeURL($security_hash))
			]);

		return redirect('auth/dashboard/');
	}

	public function gitHubCallBackLogin($request)
	{
		$request = (object) $request->getQueryParams();
		$code = $request->code ?? null;
		$state = $request->state ?? null;

		if($code === null and $state === null)
			return redirect('/');

		$api_access_token = $this->git_hub_controller->getAccessToken($request->state, $request->code);

		saveSession('code', $request->code);
		saveSession('state', $request->state);
		saveSession('access_token', $api_access_token->access_token);
		return redirect('auth/dashboard/');
	}
}