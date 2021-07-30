<?php
namespace App\Services;

use App\Repositories\UserRepositoryInterface;

class AuthService implements AuthServiceInterface
{

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * AuthService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function login($request)
    {
        $userData = $this->userRepository->checkLogin($request->email, md5($request->password));
        saveSession('user', $userData);
        return $userData;
    }
}