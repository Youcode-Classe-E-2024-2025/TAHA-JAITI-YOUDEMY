<?php

class User
{
    private Database $pdo;
    private ?int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role;
    private string $status;

    public function __construct()
    {
        $this->pdo = new Database();
        $this->id = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = '';
        $this->status = '';
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getStatus(): string
    {
        return $this->status;
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

    public function setEmail(string $email): void
    {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function create(): bool
    {
        $sql = 'INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)';
        return $this->pdo->execute($sql, [
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => $this->password,
            ':role' => $this->role,
        ]);
    }

    public function getByEmail(): ?array
    {
        if (empty($this->email)) {
            return [];
        }

        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        return $this->pdo->fetch($sql, [':email' => $this->email]);
    }

    public function getById(): ?array
    {
        if (empty($this->id)) {
            return [];
        }

        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        return $this->pdo->fetch($sql, [':id' => $this->id]);
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM users WHERE role != 'admin' ORDER BY id ASC";
        return $this->pdo->fetchAll($sql);
    }

    public function getAllTeachers(): array{
        $sql = "SELECT id, name FROM users WHERE role = 'teacher'";
        return $this->pdo->fetchAll($sql);
    }

    public function updateStatus(): bool
    {
        if (empty($this->id) || empty($this->status)) {
            return false;
        }

        $sql = "UPDATE users SET status = :status WHERE id = :id";
        return $this->pdo->execute($sql, [
            ':status' => $this->status,
            ':id' => $this->id,
        ]);
    }

    public function delete(): bool
    {
        if (empty($this->id)) {
            return false;
        }

        $sql = "DELETE FROM users WHERE id = :id";
        return $this->pdo->execute($sql, [':id' => $this->id]);
    }
}