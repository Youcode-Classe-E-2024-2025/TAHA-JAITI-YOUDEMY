<?php

class Category
{
    private Database $pdo;
    private ?int $id;
    private string $name;

    public function __construct()
    {
        $this->pdo = new Database();
        $this->id = null;
        $this->name = '';
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function create(): bool
    {
        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $success = $this->pdo->execute($sql, [':name' => $this->name]);

        if ($success) {
            $this->id = $this->pdo->lastInsertId();
        }

        return $success;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM categories ORDER BY id ASC";
        return $this->pdo->fetchAll($sql);
    }

    public function getById(): ?self
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $data = $this->pdo->fetch($sql, [':id' => $this->id]);

        if (!$data) {
            return null;
        }

        $category = new self();
        $category->setId($data['id']);
        $category->setName($data['name']);

        return $category;
    }

    public function delete(): bool
    {
        if (!$this->id) {
            return false;
        }

        $sql = "DELETE FROM categories WHERE id = :id";
        return $this->pdo->execute($sql, [':id' => $this->id]);
    }

    public function update(): bool {
        if (!$this->id || !$this->name) {
            return false;
        }

        $sql = "UPDATE categories SET name = :name WHERE id = :id";
        return $this->pdo->execute($sql, [':name' => $this->name, ':id' => $this->id]);
    }
}