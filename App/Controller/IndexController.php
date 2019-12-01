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

use Psr\Http\Message\ResponseInterface;

/**
 * Class Controller.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class IndexController extends Controller
{

	/**
     * @var ResponseInterface
     */
	private $response;

	public function __construct(ResponseInterface $response)
	{
		parent::__construct();
		$this->response = $response;
	}

	public function index()
	{
		
	}
}