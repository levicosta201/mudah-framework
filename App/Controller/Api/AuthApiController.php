<?php
namespace App\Controller\Api;

use App\Controller\Controller;
use App\Services\AuthServiceInterface;
use Psr\Http\Message\ResponseInterface;

class AuthApiController extends Controller
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    protected $authServie;

    /**
     * AuthApiController constructor.
     * @param ResponseInterface $response
     */
    public function __construct(
        ResponseInterface $response,
        AuthServiceInterface $authService
    )
    {
        parent::__construct();
        $this->authServie = $authService;
        $this->response = $response;
    }

    /**
     * @param $request
     * @return false|string
     */
    public function index($request)
    {
        try {

            $request = (object) $request->getParsedBody();

            if (!isset($request->email) || !isset($request->password)) {
                throw new \Exception('Por favor informe o usuário e a senha');
            }

            $authUser = $this->authServie->login($request);

            if (!$authUser) {
                return json_encode([
                    'succes' => false,
                    'data' => 'Invalid user or password'
                ]);
            }

            return json_encode([
                'success' => true,
                'data' => $authUser
            ]);
        } catch (\Exception $exception) {
            return json_encode([
                'succes' => false,
                'data' => $exception->getMessage()
            ]);
        }
    }
}