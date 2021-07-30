<?php
namespace App\Model;

class User extends Connection
{
    public $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }
}