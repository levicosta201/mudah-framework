<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */

namespace App\Controller;



/**
 * Class Controller.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class Controller
{
	/**
     * @var integer
     */
	public $default_user_id;

	public function __construct()
	{
		$this->default_user_id = 1;
	}
}