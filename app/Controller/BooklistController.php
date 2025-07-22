<?php

namespace EShopPhp\Controller;

use EShopPhp\App\View;
use EShopPhp\Config\Database;
use EShopPhp\Exception\ValidationException;
use EShopPhp\Model\AddBooklistRequest;
use EShopPhp\Repository\BooklistRepository;
use EShopPhp\Service\BooklistService;

class BooklistController
{
    private BooklistService $booklistService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $booklistRepository = new BooklistRepository($connection);
        $this->booklistService = new BooklistService($booklistRepository);
    }

    public function index(): void
    {
        $booklist = $this->booklistService->showBooklist();

        View::render("index", [
            "title" => "Booklist PHP",
            "booklist" => $booklist
        ]);
    }

    public function addBooklist(): void
    {
        View::render("add", [
            "title" => "Add New Booklist"
        ]);
    }

    public function postAddBooklist(): void 
    {
        $request = new AddBooklistRequest();
        $request->book = $_POST['book'];

        try {
            $this->booklistService->addBooklist($request);
            View::redirect("/");
        } catch (ValidationException $exception) {
            View::render("add", [
                "title" => "Add New Booklist",
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function postDeleteBooklist()
    {
        $id = $_GET['id'];
        $this->booklistService->deleteBooklist($id);
        View::redirect("/");
    }
}