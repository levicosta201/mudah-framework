<?php
namespace App\Repositories;

use App\Model\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(
        User $user
    )
    {
        $this->user = $user;
    }

    public function checkLogin($email, $password)
    {
        return $this->user->db->select(['id', 'name', 'email'])
                    ->from($this->user->table)
                    ->where('email', '=', $email)
                    ->where('password', '=', $password)
                    ->execute()
                    ->fetch();
    }
}