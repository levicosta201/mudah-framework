<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */
declare(strict_types=1);
namespace App\Controller;

use Jenssegers\Blade\Blade;

/**
 * Class Controller.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class Controller
{

	/**
     * @var Blade (use to call view)
     */
	public $blade;

	/**
     * @var integer
     */
	public $default_user_id;

	public function __construct()
	{
		$this->default_user_id = 1;
		$this->blade = new Blade(dirname(__DIR__).'/View', dirname(__DIR__).'/Cache');
	}
}