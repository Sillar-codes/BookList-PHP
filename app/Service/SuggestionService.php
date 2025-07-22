<?php

namespace EShopPhp\Service;

use EShopPhp\Config\Database;
use EShopPhp\Domain\Booklist;
use EShopPhp\Exception\ValidationException;
use EShopPhp\Model\AddBooklistRequest;
use EShopPhp\Model\AddBooklistResponse;
use EShopPhp\Repository\BooklistRepository;

class SuggestionService
{
    private \PDO $connection;

    public function __construct(
        private BooklistRepository $booklistRepository
    ) {
        $this->connection = Database::getConnection();
    }

    public function addBooklist(AddBooklistRequest $request): ?AddBooklistResponse
    {
        $this->validateAddBooklistRequest($request);

        try {
            Database::beginTransaction();
            $booklist = new Booklist();
            $booklist->book = $request->book;

            $this->booklistRepository->save($booklist);
            $booklist->id = $this->connection->lastInsertId();

            $response = new AddBooklistResponse();
            $response->booklist = $booklist;

            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateAddBooklistRequest(AddBooklistRequest $request)
    {
        if ($request->book == null || trim($request->book) == "") {
            throw new ValidationException("Book name cannot blank");
        }
    }

    public function showBooklist(): array
    {
        return $this->booklistRepository->findAll();
    }

    public function deleteBooklist(string $id): bool
    {
        return $this->booklistRepository->remove($id);
    }
}
