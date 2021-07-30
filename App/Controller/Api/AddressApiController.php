<?php
namespace App\Controller\Api;

use App\Controller\Controller;
use App\Services\AddressServiceInterface;

class AddressApiController extends Controller
{
    /**
     * @var AddressServiceInterface
     */
    protected $addressService;

    /**
     * AddressController constructor.
     * @param AddressServiceInterface $addressService
     */
    public function __construct(
        AddressServiceInterface $addressService
    )
    {
        parent::__construct();
        $this->addressService = $addressService;
    }

    /**
     * @param $request
     * @return false|string
     */
    public function add($request)
    {
        try {
            $request = (object) $request->getParsedBody();

            if (
                !isset($request->client_id) ||
                !isset($request->address) ||
                !isset($request->postal_code) ||
                !isset($request->city) ||
                !isset($request->state)
            ) {
                throw new \Exception('Por favor informe todos os campos');
            }

            $saveAddress = $this->addressService->store($request);

            if (!$saveAddress) {
                return json_encode([
                    'succes' => false,
                    'data' => 'Erro ao salvar endereço'
                ]);
            }

            return json_encode([
                'success' => true,
                'data' => 'Endereço salvo com sucesso'
            ]);
        } catch (\Exception $exception) {
            return json_encode([
                'succes' => false,
                'data' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $request
     * @return false|string
     */
    public function delete($request)
    {
        try {
            $request = (object) $request->getParsedBody();

            if (!isset($request->id)) {
                throw new \Exception('Por favor informe o endereço a ser deletado');
            }

            $deleteAddress = $this->addressService->delete($request);

            if (!$deleteAddress) {
                return json_encode([
                    'succes' => false,
                    'data' => 'Erro ao deletar o endereço'
                ]);
            }

            return json_encode([
                'success' => true,
                'data' => 'Endereço deletado com sucesso'
            ]);
        } catch (\Exception $exception) {
            return json_encode([
                'succes' => false,
                'data' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $request
     * @return false|string
     */
    public function edit($request)
    {
        try {
            $request = (object) $request->getParsedBody();

            if (!isset($request->id) || !isset($request->client_id) || $request->client_id == 0) {
                throw new \Exception('Por favor informe o endereço a ser editado');
            }

            $deleteAddress = $this->addressService->update($request);

            if (!$deleteAddress) {
                return json_encode([
                    'succes' => false,
                    'data' => 'Erro ao editar o endereço'
                ]);
            }

            return json_encode([
                'success' => true,
                'data' => 'Endereço editado com sucesso'
            ]);
        } catch (\Exception $exception) {
            return json_encode([
                'succes' => false,
                'data' => $exception->getMessage()
            ]);
        }
    }
}