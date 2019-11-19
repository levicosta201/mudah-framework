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

class LogModel extends Connection
{

	/**
     * @var string
     * @label('table name')
     */
	private static $table = 'logs';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function saveLog(int $user_id, string $action)
	{
		$insert = $this->db->insert(['user_id' => $user_id, 'action' => $action])->into(self::$table);
		return $insert->execute();
	}

	public function getAll()
	{
		return $this->db->select()->from(self::$table)->execute()->fetchAll();
	}
}