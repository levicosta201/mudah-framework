<?php
declare(strict_types=1);

namespace App\Controller;


use Psr\Http\Message\ResponseInterface;
use App\Model\LogModel as LogModel;
use FlyingLuscas\Correios\Client;
use FlyingLuscas\Correios\Service;

class IndexController extends Controller
{

    /**
     * @var ResponseInterface
     */
	private $response;
	/**
     * @var LogModel
     */
    private $log_model;
    
	public function __construct(ResponseInterface $response)
	{
		parent::__construct();
        $this->response = $response;
    }   

    public function index()
    {
        $correios = new Client;

        $correios = $correios->freight()
            ->origin('39900-000')
            ->destination('04289-000')
            ->services(Service::SEDEX, Service::PAC)
            ->item(16, 16, 16, .3, 1) // largura, altura, comprimento, peso e quantidade
            ->item(16, 16, 16, .3, 3) // largura, altura, comprimento, peso e quantidade
            ->item(16, 16, 16, .3, 2) // largura, altura, comprimento, peso e quantidade
            ->calculate();

        print_r($correios);
    }
}