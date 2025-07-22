<?php

namespace EShopPhp\Controller;

use EShopPhp\App\View;
use EShopPhp\Config\Database;
use EShopPhp\Exception\ValidationException;
use EShopPhp\Model\SignUpRequest;
use EShopPhp\Model\SignInRequest;
use EShopPhp\Repository\UserRepository;
use EShopPhp\Service\UserService;

session_start();

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }

    public function index(): void
    {
    }

    public function SignUpPage(): void
    {
        View::render("signup", [
            "title" => "Sign Up"
        ]);
    }

    public function SignInPage(): void
    {
        View::render("signin", [
            "title" => "Sign In"
        ]);
    }

    public function signUp(): void
    {
        if ($_POST['username'] == '' || $_POST['email'] == '' || $_POST['password'] == '') {
            throw new ValidationException("Fields are required");
        }
        $request = new SignUpRequest();
        $request->username = $_POST['username'];
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        try {
            $response = $this->userService->signUp($request);

            $_SESSION['user'] = $response->user->id;

            View::redirect("/");
        } catch (ValidationException $exception) {
            View::render("signup", [
                "title" => "Sign Up",
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function signIn(): void
    {
        $request = new SignInRequest();
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        try {
            $user = $this->userService->signIn($request);

            $_SESSION['user'] = $user->id;

            View::redirect("/");
        } catch (ValidationException $exception) {
            View::render("signin", [
                "title" => "Sign In",
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        View::redirect("/signin");
    }
}