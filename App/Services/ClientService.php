<?php
namespace App\Services;

use App\Repositories\ClientRepositoryInterface;

class ClientService implements ClientServiceInterface
{
    /**
     * @var ClientRepositoryInterface
     */
    protected $clientRepository;

    /**
     * ClientService constructor.
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct(
        ClientRepositoryInterface $clientRepository
    )
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $name = $request->name;
        $birthday = $request->birthday;
        $cpf = cleanString($request->cpf);
        $document_number = strtoupper(cleanString($request->document_number));
        $phone = cleanString($request->phone);

        return $this->clientRepository->store($name, $cpf, $document_number, $phone, $birthday);
    }

    public function update($request)
    {
        $id = $request->id;
        $name = $request->name;
        $birthday = $request->birthday;
        $cpf = cleanString($request->cpf);
        $document_number = strtoupper(cleanString($request->document_number));
        $phone = cleanString($request->phone);

        return $this->clientRepository->update([
            'name' => $name,
            'cpf' => $cpf,
            'document_number' => $document_number,
            'phone' => $phone,
            'birthday' => $birthday
        ], $id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->clientRepository->all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function delete($request)
    {
        $id = $request->id;

        return $this->clientRepository->delete($id);
    }

    public function byId($request)
    {
        $id = $request->id;

        return $this->clientRepository->byId($id);
    }
}