<?php
namespace App\Repositories;

interface ClientRepositoryInterface
{
    public function store($name, $cpf, $document_number, $phone, $birthday);

    public function all();

    public function delete($id);

    public function byId($id);

    public function update($params, $id);
}