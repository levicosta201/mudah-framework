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

use App\Controller\IndexController;

use Psr\Http\Message\ResponseInterface;

/**
 * Class LogsController.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class ApiController extends Controller
{

	/**
     * @var ResponseInterface
     */
	private $response;

	/**
     * @var LogModel
     */
	private $log_model;

	/**
     * @var string
     */
	private $session_id;

	public function __construct(ResponseInterface $response)
	{
		parent::__construct();
		$this->response = $response;
	}

	public function getProductData($request)
	{	
		$index_controller = new IndexController;
		$request = (object) $request->getQueryParams();
		$product_id = $request->product_id;
		$response = json_decode($index_controller->getProductData($product_id))->response;
		return json_encode($response);
	}
}