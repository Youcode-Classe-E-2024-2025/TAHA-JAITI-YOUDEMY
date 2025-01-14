<?php

class Tag
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
        $sql = "INSERT INTO tags (name) VALUES (:name)";
        $success = $this->pdo->execute($sql, [':name' => $this->name]);

        if ($success) {
            $this->id = $this->pdo->lastInsertId();
        }

        return $success;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM tags";
        return $this->pdo->fetchAll($sql);
    }

    public function getById(): ?self
    {
        if (!$this->id) {
            return null;
        }

        $sql = "SELECT * FROM tags WHERE id = :id";
        $data = $this->pdo->fetch($sql, [':id' => $this->id]);

        if (!$data) {
            return null;
        }

        $tag = new self();
        $tag->setId($data['id']);
        $tag->setName($data['name']);

        return $tag;
    }

    public function delete(): bool
    {
        if (!$this->id) {
            return false;
        }

        $sql = "DELETE FROM tags WHERE id = :id";
        return $this->pdo->execute($sql, [':id' => $this->id]);
    }
}