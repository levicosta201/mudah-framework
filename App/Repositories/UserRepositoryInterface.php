<?php
namespace App\Repositories;

interface UserRepositoryInterface
{
    public function checkLogin($email, $password);
}