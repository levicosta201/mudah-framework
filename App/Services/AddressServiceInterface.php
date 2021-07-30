<?php
namespace App\Services;

interface AddressServiceInterface
{
    public function store($request);

    public function all();

    public function delete($request);

    public function byId($request);

    public function update($request);

    public function byClientId($client_id);

}