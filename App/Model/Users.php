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
namespace App\Model;

class Users extends Connection
{

	/**
     * @var string
     * @label('table name')
     */
	private static $table = 'users';
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Save User
	 * @param int github_id
	 * @param string name
	 * @param string email
	 * @param string url_profile
	 * @param int public_repos
	 * @param int public_gists
	 * @param int public_gists
	 * @param int followers
	 * @param int following
	 * @return query response
	*/
	public function saveUser(int $github_id, string $name, string $email, string $url_profile, int $public_repos, int $public_gists, int $followers, int $following)
	{
		$insert = $this->db->insert([
			'github_id' => $github_id,
			'name' => $name,
			'email' => $email,
			'url_profile' => $url_profile,
			'public_repos' => $public_repos,
			'public_gists' => $public_gists,
			'followers' => $followers,
			'following' => $following,
		])->into(self::$table);

		return $insert->execute();
	}

	/**
	 * Update user using github_id with reference
	 * @param int github_id
	 * @param array params
	 * @return query response
	*/
	public function updateUser(int $github_id, array $params)
	{
		$data = $this->db->update($params)->table(self::$table)->where('github_id', '=', $github_id)->execute();
		return $data;
	}

	/**
	 * Get user using github_id with reference
	 * @param int github_id
	 * @return query response
	*/
	public function getUserDataById($github_id)
	{
		$data = $this->db->select()->from(self::$table)->where('github_id', '=', $github_id)->execute()->fetch();
		return $data;
	}
}