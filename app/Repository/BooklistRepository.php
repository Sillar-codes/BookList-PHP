<?php

namespace EShopPhp\Repository;

use EShopPhp\Domain\Booklist;

class BooklistRepository
{
    public function __construct(
        private \PDO $connection
    ) {
    }

    public function save(Booklist $booklist): void
    {
        $statement = $this->connection->prepare("INSERT INTO booklist(book) VALUES (?)");
        $statement->execute([$booklist->book]);
    }

    public function findById(string $id): ?Booklist
    {
        $statement = $this->connection->prepare("SELECT id, book FROM booklist WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $booklist = new Booklist();
                $booklist->id = $row['id'];
                $booklist->book = $row['book'];
                return $booklist;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll()
    {
        $this->connection->exec("DELETE FROM booklist");
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT id, book FROM booklist");
        $statement->execute();

        return $statement->fetchAll();
    }

    public function remove(string $id): bool
    {
        $statement = $this->connection->prepare("SELECT id FROM booklist WHERE id = ?");
        $statement->execute([$id]);

        if ($statement->fetch()) {
            $statement = $this->connection->prepare("DELETE FROM booklist WHERE id = ?");
            $statement->execute([$id]);
            return true;
        }

        return false;
    }
}
