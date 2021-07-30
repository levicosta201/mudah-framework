<?php
namespace App\Services;

use App\Repositories\AddressRepositoryInterface;

class AddressService implements AddressServiceInterface
{
    /**
     * @var AddressRepositoryInterface
     */
    protected $addressRepository;

    /**
     * AddressService constructor.
     * @param AddressRepositoryInterface $addressRepository
     */
    public function __construct(
        AddressRepositoryInterface $addressRepository
    )
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $client_id = $request->client_id;
        $address = $request->address;
        $postal_code = cleanString($request->postal_code);
        $city = $request->city;
        $state = strtoupper($request->state);

        return $this->addressRepository->store($client_id, $address, $postal_code, $city, $state);
    }

    public function update($request)
    {
        $id = $request->id;
        $client_id = $request->client_id;
        $address = $request->address;
        $postal_code = cleanString($request->postal_code);
        $city = $request->city;
        $state = strtoupper($request->state);

        return $this->addressRepository->update([
            'client_id' => $client_id,
            'address' => $address,
            'postal_code' => $postal_code,
            'city' => $city,
            'state' => $state
        ], $id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->addressRepository->all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function delete($request)
    {
        $id = $request->id;

        return $this->addressRepository->delete($id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function byId($request)
    {
        $id = $request->id;

        return $this->addressRepository->byId($id);
    }

    /**
     * @param $client_id
     * @return mixed
     */
    public function byClientId($client_id)
    {
        return $this->addressRepository->byClientId($client_id);
    }
}