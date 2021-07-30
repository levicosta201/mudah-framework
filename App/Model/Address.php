<?php
namespace App\Model;

class Address extends Connection
{
    public $table = 'address';

    public function __construct()
    {
        parent::__construct();
    }
}