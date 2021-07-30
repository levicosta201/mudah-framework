<?php
namespace App\Repositories;

interface AddressRepositoryInterface
{
    public function store($client_id, $address, $postal_code, $city, $state);

    public function all();

    public function delete($id);

    public function byId($id);

    public function update($params, $id);

    public function byClientId($client_id);
}