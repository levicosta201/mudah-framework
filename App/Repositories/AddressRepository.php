<?php
namespace App\Repositories;

use App\Model\Address;
use App\Model\Client;

class AddressRepository implements AddressRepositoryInterface
{
    /**
     * @var Address
     */
    protected $address;

    /**
     * @var Client
     */
    protected $client;

    /**
     * AddressRepository constructor.
     * @param Address $address
     */
    public function __construct(
        Address $address,
        Client $client
    )
    {
        $this->address = $address;
        $this->client = $client;
    }

    /**
     * @param $name
     * @param $cpf
     * @param $document_number
     * @param $phone
     * @param $birthday
     * @return string
     */
    public function store($client_id, $address, $postal_code, $city, $state)
    {
        return $this->address->db
            ->insert([
                'client_id' => $client_id,
                'address' => $address,
                'postal_code' => $postal_code,
                'city' => $city,
                'state' => $state
            ])
            ->into($this->address->table)
            ->execute();
    }

    public function update($params, $id)
    {
        return $this->address->db
            ->update($params)
            ->table($this->address->table)
            ->where('id', '=', $id)
            ->execute();
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->address
            ->db
            ->select([
                $this->address->table. '.*',
                $this->address->table. '.id AS address_id',
                $this->client->table. '.name as client_name, ' . $this->client->table. '.id as client_id',
            ])
            ->join($this->client->table, $this->client->table . '.id', '=', $this->address->table. '.client_id')
            ->from($this->address->table)
            ->execute()
            ->fetchAll();
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return $this->address
            ->db
            ->delete($this->address->table)
            ->where('id', '=', $id)
            ->execute();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return $this->address
            ->db
            ->select([
                $this->address->table. '.*',
                $this->address->table. '.id AS address_id',
                $this->client->table. '.name as client_name, ' . $this->client->table. '.id as client_id',
            ])
            ->join($this->client->table, $this->client->table . '.id', '=', $this->address->table. '.client_id')
            ->from($this->address->table)
            ->where($this->address->table.'.id', '=', $id)
            ->execute()
            ->fetch();
    }

    /**
     * @param $client_id
     * @return array
     */
    public function byClientId($client_id)
    {
        return $this->address
            ->db
            ->select([
                $this->address->table. '.*',
                $this->address->table. '.id AS address_id',
                $this->client->table. '.name as client_name, ' . $this->client->table. '.id as client_id',
            ])
            ->join($this->client->table, $this->client->table . '.id', '=', $this->address->table. '.client_id')
            ->from($this->address->table)
            ->where('client_id', '=', $client_id)
            ->execute()
            ->fetchAll();
    }
}