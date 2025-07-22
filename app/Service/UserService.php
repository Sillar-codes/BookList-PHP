<?php

namespace EShopPhp\Service;

use EShopPhp\Config\Database;
use EShopPhp\Domain\User;
use EShopPhp\Exception\ValidationException;
use EShopPhp\Model\SignInRequest;
use EShopPhp\Model\SignInResponse;
use EShopPhp\Model\SignUpRequest;
use EShopPhp\Model\SignUpResponse;
use EShopPhp\Repository\UserRepository;

class UserService
{
    private \PDO $connection;

    public function __construct(
        private UserRepository $userRepository
    ) {
        $this->connection = Database::getConnection();
    }

    public function signUp(SignUpRequest $request): ?SignUpResponse
    {
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;

        $this->userRepository->save($user);
        $user->id = $this->connection->lastInsertId();

        $response = new SignUpResponse();
        $response->user = $user;

        return $response;
    }

    public function signIn(SignInRequest $request): ?User
    {
        $user = $this->userRepository->findByEmail($request->email);
        if ($user == null) {
            throw new ValidationException("User doesn't exist");
        }
        if ($user->password != $request->password) {
            throw new ValidationException("Pasword doesn't match");
        }
        return $user;
    }

    public function showUserList(): array
    {
        return $this->userRepository->findAll();
    }

    public function deleteBooklist(string $id): bool
    {
        return $this->userRepository->remove($id);
    }
}
