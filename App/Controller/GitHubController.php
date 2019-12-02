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

	/**
	 * Connect to github for get access token
	 * @param String $state
	 * @param String $o_auth_code
	 * @return String
	*/
	public function getAccessToken($state, $o_auth_code) 
	{
		return $token = $this->apiRequest(self::TOKEN_URL . '?' . http_build_query([
			'client_id' => self::CLIENT_ID,
			'client_secret' => self::CLIENT_SECRET,
			'state' => $state,
			'code'=> $o_auth_code,
		]));
	}

	/**
	 * create call for get response api get token github
	 * @param String $access_token_url
	 * @return String
	*/
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

	/**
	 * Get client id is seted in class
	 * @param void
	 * @return String
	*/
	public function getClientId() : string
	{
		return self::CLIENT_ID;
	}

	/**
	 * Get client secret is seted in class
	 * @param void
	 * @return String
	*/
	public function getClientSecret() : string
	{
		return self::CLIENT_SECRET;
	}

	/**
	 * Get user data from api, not DB and not session
	 * @param String $access_token_url
	 * @return array
	*/
	public function getUserData($access_token_url)
	{
		return $this->sendCurl('https://api.github.com/user', $access_token_url);
	}

	/**
	 * Get all repos from auth user
	 * @param String $access_token_url
	 * @return array
	*/
	public function getUserRepos($access_token_url)
	{
		return $this->sendCurl('https://api.github.com/users/levicosta201/repos', $access_token_url);
	}

	/**
	 * Get details from specified repo
	 * @param String $url
	 * @param String $access_token_url
	 * @return array
	*/
	public function getRepoDetail($url, $access_token_url)
	{
		return $this->sendCurl($url, $access_token_url);
	}

	/**
	 * Get all branches from specified repo
	 * @param String $url
	 * @param String $access_token_url
	 * @return array
	*/
	public function getRepoBranche($url, $access_token_url)
	{
		return $this->sendCurl($url, $access_token_url);
	}

	/**
	 * Get details from specified branch
	 * @param String $url
	 * @param String $access_token_url
	 * @return array
	*/
	public function getBrancheDetail($url, $access_token_url)
	{
		return $this->sendCurl($url, $access_token_url);
	}

	/**
	 * Create query from search repo
	 * @param String $url
	 * @param String $access_token_url
	 * @param String $query (use by search repo)
	 * @param String $language
	 * @return array
	*/
	public function searchRepo($url, $access_token_url, $query, $language)
	{
		return $this->sendCurl($url . '?q=' .$query . '+language:'.$language.'&sort=stars&order=desc', $access_token_url);
	}

	/**
	 * Create curl request to connect in any endpoint from github api
	 * @param String $url
	 * @param String $access_token_url
	 * @return Url Response
	*/
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