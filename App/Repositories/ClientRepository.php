<?php
namespace App\Repositories;

use App\Model\Client;

class ClientRepository implements ClientRepositoryInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * ClientRepository constructor.
     * @param Client $client
     */
    public function __construct(
        Client $client
    )
    {
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
    public function store($name, $cpf, $document_number, $phone, $birthday)
    {
        return $this->client->db
            ->insert([
                'name' => $name,
                'cpf' => $cpf,
                'document_number' => $document_number,
                'phone' => $phone,
                'birthday' => $birthday
            ])
            ->into($this->client->table)
            ->execute();
    }

    public function update($params, $id)
    {
        return $this->client->db
            ->update($params)
            ->table($this->client->table)
            ->where('id', '=', $id)
            ->execute();
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->client
            ->db
            ->select()
            ->from($this->client->table)
            ->execute()
            ->fetchAll();
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return $this->client
            ->db
            ->delete($this->client->table)
            ->where('id', '=', $id)
            ->execute();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return $this->client
            ->db
            ->select()
            ->from($this->client->table)
            ->where('id', '=', $id)
            ->execute()
            ->fetch();
    }
}