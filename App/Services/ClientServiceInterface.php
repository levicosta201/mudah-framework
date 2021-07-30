<?php
namespace App\Services;

interface ClientServiceInterface
{
    public function store($request);

    public function all();

    public function delete($request);

    public function byId($request);

    public function update($request);

}