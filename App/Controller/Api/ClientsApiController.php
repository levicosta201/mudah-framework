<?php
namespace App\Controller\Api;

use App\Controller\Controller;
use App\Services\ClientServiceInterface;

class ClientsApiController extends Controller
{
    /**
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     * ClientsController constructor.
     * @param ClientServiceInterface $clientService
     */
    public function __construct(
        ClientServiceInterface $clientService
    )
    {
        parent::__construct();
        $this->clientService = $clientService;
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
                !isset($request->name) ||
                !isset($request->birthday) ||
                !isset($request->cpf) ||
                !isset($request->document_number) ||
                !isset($request->phone)
            ) {
                throw new \Exception('Por favor informe todos os campos');
            }

            $saveClient = $this->clientService->store($request);

            if (!$saveClient) {
                return json_encode([
                    'succes' => false,
                    'data' => 'Erro ao salvar cliente'
                ]);
            }

            return json_encode([
                'success' => true,
                'data' => 'Cliente salvo com sucesso'
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
                throw new \Exception('Por favor o cliente a ser deletado');
            }

            $deleteClient = $this->clientService->delete($request);

            if (!$deleteClient) {
                return json_encode([
                    'succes' => false,
                    'data' => 'Erro ao deletar o cliente'
                ]);
            }

            return json_encode([
                'success' => true,
                'data' => 'Cliente deletado com sucesso'
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

            if (!isset($request->id)) {
                throw new \Exception('Por favor informe o cliente a ser editado');
            }

            $deleteClient = $this->clientService->update($request);

            if (!$deleteClient) {
                return json_encode([
                    'succes' => false,
                    'data' => 'Erro ao editar o cliente'
                ]);
            }

            return json_encode([
                'success' => true,
                'data' => 'Cliente editado com sucesso'
            ]);
        } catch (\Exception $exception) {
            return json_encode([
                'succes' => false,
                'data' => $exception->getMessage()
            ]);
        }
    }
}