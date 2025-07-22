<?php

namespace EShopPhp\Service;

use EShopPhp\Config\Database;
use EShopPhp\Domain\Booklist;
use EShopPhp\Exception\ValidationException;
use EShopPhp\Model\AddBooklistRequest;
use EShopPhp\Repository\BooklistRepository;
use PHPUnit\Framework\TestCase;

class BooklistServiceTest extends TestCase
{
    private \PDO $connection;
    private BooklistRepository $booklistRepository;
    private BooklistService $booklistService;

    protected function setUp(): void
    {
        $this->connection = Database::getConnection();
        $this->booklistRepository = new BooklistRepository($this->connection);
        $this->booklistService = new BooklistService($this->booklistRepository);

        $this->booklistRepository->deleteAll();
    }

    public function testAddBooklistSuccess()
    {
        $request = new AddBooklistRequest();
        $request->book = "Atomic Habits";

        $response = $this->booklistService->addBooklist($request);

        self::assertEquals($request->book, $response->booklist->book);
    }

    public function testAddBooklistFailed()
    {
        $request = new AddBooklistRequest();
        $request->book = "";

        $this->expectException(ValidationException::class);
        $this->booklistService->addBooklist($request);
    }

    public function testShowBooklist()
    {
        $booklist1 = new Booklist();
        $booklist1->book = "Atomic Habits";
        $booklist2 = new Booklist();
        $booklist2->book = "Filosofi Teras";

        $this->booklistRepository->save($booklist1);
        $this->booklistRepository->save($booklist2);

        $result = $this->booklistService->showBooklist();

        self::assertIsArray($result);
        self::assertCount(2, $result);
    }

    public function testShowBooklistEmpty()
    {
        $result = $this->booklistService->showBooklist();

        self::assertIsArray($result);
        self::assertCount(0, $result);
    }

    public function testDeleteBooklistSuccess()
    {
        $booklist = new Booklist();
        $booklist->book = "Atomic Habits";

        $this->booklistRepository->save($booklist);
        $booklistId = $this->booklistRepository->findAll();

        $result = $this->booklistService->deleteBooklist($booklistId[0]['id']);

        self::assertTrue($result);
    }

    public function testDeleteBooklistFailed()
    {
        $result = $this->booklistService->deleteBooklist("Failed");

        self::assertFalse($result);
    }
}