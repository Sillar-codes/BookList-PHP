<?php

namespace EShopPhp\Repository;

use EShopPhp\Domain\User;

class UserRepository
{
    public function __construct(
        private \PDO $connection
    ) {
    }

    public function save(User $user): void
    {
        $statement = $this->connection->prepare("INSERT INTO users(username, email, password) VALUES (?,?,?)");
        $statement->execute([$user->username, $user->email, $user->password]);
    }

    public function findById(string $id): ?Booklist
    {
        $statement = $this->connection->prepare("SELECT id, username FROM users WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->username = $row['username'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByEmail(string $email): ?User
    {
        $statement = $this->connection->prepare("SELECT id, username, email, password FROM users WHERE email = ?");
        $statement->execute([$email]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->username = $row['username'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll()
    {
        $this->connection->exec("DELETE FROM users");
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT id, username FROM users");
        $statement->execute();

        return $statement->fetchAll();
    }

    public function remove(string $id): bool
    {
        $statement = $this->connection->prepare("SELECT id FROM users WHERE id = ?");
        $statement->execute([$id]);

        if ($statement->fetch()) {
            $statement = $this->connection->prepare("DELETE FROM users WHERE id = ?");
            $statement->execute([$id]);
            return true;
        }

        return false;
    }
}
