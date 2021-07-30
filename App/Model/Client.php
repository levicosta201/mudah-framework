<?php
namespace App\Model;

class Client extends Connection
{
    public $table = 'clients';

    public function __construct()
    {
        parent::__construct();
    }
}