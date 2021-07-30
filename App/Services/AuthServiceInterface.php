<?php
namespace App\Services;

interface AuthServiceInterface
{
    /**
     * @return mixed
     */
    public function login($request);
}