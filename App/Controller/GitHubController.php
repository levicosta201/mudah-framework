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

/**
 * Class Controller.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class GitHubController
{

	const AUTHORIZE_URL = 'https://github.com/login/oauth/authorize';
	const TOKEN_URL = 'https://github.com/login/oauth/access_token';
	const GIT_HUB_API_URL = 'https://api.github.com/';
	const CLIENT_ID = '115fd34142024b6e5b82';
	const CLIENT_SECRET = 'd351510603c15a33497f9f0299d558b0d44dba2f';
	const REDIRECT_URI = 'https://git-teste-api-php.herokuapp.com/github/callback/';
	
	public function getAuthorizeUrl(string $state, string $scope = 'user:email')
	{
		return self::AUTHORIZE_URL . '?' . http_build_query([
			'client_id' => self::CLIENT_ID,
			'redirect_uri' => self::REDIRECT_URI,
			'state' => $state,
			'scope'=> $scope,
		]);
	}

	public function getAccessToken($state, $o_auth_code) 
	{
		return $token = $this->apiRequest(self::TOKEN_URL . '?' . http_build_query([
			'client_id' => self::CLIENT_ID,
			'client_secret' => self::CLIENT_SECRET,
			'state' => $state,
			'code'=> $o_auth_code,
		]));
	}

	public function apiRequest($access_token_url)
	{
		$api_url = filter_var($access_token_url, FILTER_VALIDATE_URL) ? $access_token_url : self::GIT_HUB_API_URL . 'user?access_token_url=' .self::TOKEN_URL;
		$context = stream_context_create([
			'http' => [
				'user_agent' => 'GitSearch GitHub OAuth Login',
				'header' => 'Accept: application/json',
			]
		]);
		$response = file_get_contents($api_url, false, $context);

		return $response ? json_decode($response) : $response;
	}

	public function getClientId() : string
	{
		return self::CLIENT_ID;
	}

	public function getClientSecret() : string
	{
		return self::CLIENT_SECRET;
	}

	public function getUserData($access_token_url)
	{
		return $this->sendCurl('https://api.github.com/user', $access_token_url);
	}

	public function getUserRepos($access_token_url)
	{
		return $this->sendCurl('https://api.github.com/users/levicosta201/repos', $access_token_url);
	}

	public function getRepoDetail($url, $access_token_url)
	{
		return $this->sendCurl($url, $access_token_url);
	}

	public function getRepoBranche($url, $access_token_url)
	{
		return $this->sendCurl($url, $access_token_url);
	}

	public function getBrancheDetail($url, $access_token_url)
	{
		return $this->sendCurl($url, $access_token_url);
	}

	public function searchRepo($url, $access_token_url, $query, $language)
	{
		return $this->sendCurl($url . '?q=' .$query . '+language:'.$language.'&sort=stars&order=desc', $access_token_url);
	}

	private function sendCurl($url, $access_token_url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'GitSearch GitHub OAuth Login');

		$headers = [
		    'Authorization: token ' .$access_token_url,
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		return json_decode($server_output);
	}
}