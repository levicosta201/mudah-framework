<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

class AuthController extends Controller
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * AuthController constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct();
        $this->response = $response;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return $this->blade->make('auth.index');
    }
}