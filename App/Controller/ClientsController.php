<?php
namespace App\Controller;

use App\Services\AddressServiceInterface;
use App\Services\ClientServiceInterface;

class ClientsController extends Controller
{

    /**
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     * @var AddressServiceInterface
     */
    protected $addressService;

    /**
     * ClientsController constructor.
     * @param ClientServiceInterface $clientService
     * @param AddressServiceInterface $addressService
     */
    public function __construct(
        ClientServiceInterface $clientService,
        AddressServiceInterface $addressService
    )
    {
        parent::__construct();
        $this->clientService = $clientService;
        $this->addressService = $addressService;
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index($request)
    {
        return $this->blade->make('clients.index')->with([
            'clients' => $this->clientService->all()
        ]);
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\View\View
     */
    public function add($request)
    {
        return $this->blade->make('clients.add');
    }

    public function edit($request)
    {
        $request = (object) $request->getAttributes();

        if (!isset($request->id)) {
            header('Location: '. url('clients'));
            exit;
        }

        $client = $this->clientService->byId($request);

        return $this->blade->make('clients.edit')->with([
            'client' => $client,
            'address' => $this->addressService->byClientId($client['id'])
        ]);
    }
}