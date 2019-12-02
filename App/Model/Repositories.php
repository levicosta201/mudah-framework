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

class Repositories extends Connection
{

	/**
     * @var string
     * @label('table name')
     */
	private static $table = 'repositories';
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Save repositorie 
	 * @param int github_id
	 * @param string name
	 * @param string url
	 * @param string privacity
	 * @param string language
	 * @param string description
	 * @return query response
	*/
	public function saveRespoitorie(string $name, string $url, string $privacity, string $language, string $description)
	{
		$insert = $this->db->insert([
			'name' => $name,
			'url' => $url,
			'privacity' => $privacity,
			'language' => $language,
			'description' => $description,
		])->into(self::$table);

		return $insert->execute();
	}

	/**
	 * Update repositorie using id with reference
	 * @param int id
	 * @param array params
	 * @return query response
	*/
	public function updateRepositorie(int $id, array $params)
	{
		$data = $this->db->update($params)->table(self::$table)->where('id', '=', $id)->execute();
		return $data;
	}

	/**
	 * Get user using url with reference
	 * @param int url (base64 encoded)
	 * @return query response
	*/
	public function getRepositorieByUrl($url)
	{
		$data = $this->db->select()->from(self::$table)->where('url', '=', $url)->execute()->fetch();
		return $data;
	}
}