<?php

namespace EShopPhp\Repository;

use EShopPhp\Config\Database;
use EShopPhp\Domain\Booklist;
use PHPUnit\Framework\TestCase;

class BooklistRepositoryTest extends TestCase
{
    private BooklistRepository $booklistRepository;
    private \PDO $connection;

    protected function setUp(): void
    {
        $this->connection = Database::getConnection();
        $this->booklistRepository = new BooklistRepository($this->connection);
        $this->booklistRepository->deleteAll();
    }

    public function testAddBooklistSuccess()
    {
        $booklist = new Booklist();
        $booklist->book = "Atomic Habits";

        $this->booklistRepository->save($booklist);

        $result = $this->booklistRepository->findById($this->connection->lastInsertId());

        self::assertNotNull($result);
        self::assertEquals($booklist->book, $result->book);
    }

    public function testFindByIdNotFound() 
    {
        $result = $this->booklistRepository->findById("Empty");
        self::assertNull($result);
    }

    public function testFindAll() 
    {
        $booklist1 = new Booklist();
        $booklist1->book = "Atomic Habits";
        $booklist2 = new Booklist();
        $booklist2->book = "Filosofi Teras";

        $this->booklistRepository->save($booklist1);
        $this->booklistRepository->save($booklist2);

        $result = $this->booklistRepository->findAll();

        self::assertIsArray($result);
        self::assertCount(2, $result);
    }

    public function testFindAllEmpty()
    {
        $result = $this->booklistRepository->findAll();
        
        self::assertIsArray($result);
        self::assertCount(0, $result);
    }

    public function testRemoveSuccess()
    {
        $booklist = new Booklist();
        $booklist->book = "Atomic Habits";

        $this->booklistRepository->save($booklist);
        $booklistId = $this->booklistRepository->findAll();

        $result = $this->booklistRepository->remove($booklistId[0]['id']);

        self::assertTrue($result);
    }

    public function testRemoveFailed()
    {
        $result = $this->booklistRepository->remove("Failed");

        self::assertFalse($result);
    }
}