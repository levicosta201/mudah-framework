<?php
namespace App\Controller;

use App\Services\AddressServiceInterface;
use App\Services\ClientServiceInterface;

class AddressController extends Controller
{

    /**
     * @var AddressServiceInterface
     */
    protected $addressService;

    /**
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     * AddressController constructor.
     * @param AddressServiceInterface $addressService
     */
    public function __construct(
        AddressServiceInterface $addressService,
        ClientServiceInterface $clientService
    )
    {
        parent::__construct();
        $this->addressService = $addressService;
        $this->clientService = $clientService;
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index($request)
    {
        return $this->blade->make('address.index')->with([
            'address' => $this->addressService->all()
        ]);
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\View\View
     */
    public function add($request)
    {
        return $this->blade->make('address.add')->with([
            'clients' => $this->clientService->all()
        ]);
    }

    public function edit($request)
    {
        $request = (object) $request->getAttributes();

        if (!isset($request->id)) {
            header('Location: '. url('address'));
            exit;
        }

        return $this->blade->make('address.edit')->with([
            'address' => $this->addressService->byId($request),
            'clients' => $this->clientService->all()
        ]);
    }
}