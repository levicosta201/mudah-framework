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

class Model extends Connection
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

	public function getUserData()
	{
		dd($this);
	}
}