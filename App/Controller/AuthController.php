<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

class AuthController extends Controller
{
    protected $response;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct();
        $this->response = $response;
    }

    public function index()
    {
        return $this->blade->make('auth.index');
    }
}