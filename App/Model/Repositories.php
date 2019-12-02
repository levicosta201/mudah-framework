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

	public function updateRepositorie(int $id, array $params)
	{
		$data = $this->db->update($params)->table(self::$table)->where('id', '=', $id)->execute();
		return $data;
	}

	public function getRepositorieById($id)
	{
		$data = $this->db->select()->from(self::$table)->where('id', '=', $id)->execute()->fetch();
		return $data;
	}
}