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
use App\Model\LogModel as LogModel;

/**
 * Class LogsController.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class LogsController extends Controller
{

	/**
     * @var ResponseInterface
     */
	private $response;

	/**
     * @var LogModel
     */
	private $log_model;

	public function __construct(ResponseInterface $response)
	{
		parent::__construct();
		$this->response = $response;
		$this->log_model = new LogModel;
	}

	public function index()
	{
		return $this->blade->make('logs')->with(['logs_data' => $this->log_model->getAll()]);
	}
}