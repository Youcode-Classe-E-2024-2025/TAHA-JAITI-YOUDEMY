<?php

class User{

    private Database $pdo;
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role;
    private string $status;

    public function __construct(){
        $this->pdo = new Database();
    }

    public function setId(int $id) {$this->id = $id;}
    public function setName(string $name) {$this->name = $name;}
    public function setEmail(string $email) {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
    }
    public function setPassword(string $password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
    public function setRole(string $role) {$this->role = $role;}
    public function setStatus(string $status) {$this->status = $status;}

    public function create(){
        $sql = 'INSERT INTO users(name, email, password, role) VALUES (:name, :email, :pass, :role)';
        $stmt = $this->pdo->execute($sql, [
            ':name' => $this->name,
            ':email' => $this->email,
            ':pass' => $this->password,
            ':role' => $this->role
        ]);

        return (bool) $stmt;
    }

    public function getByEmail(){
        $sql = "SELECT * FROM users WHERE email = :email";
        return $this->pdo->fetch($sql, [":email" => $this->email]);
    }

    public function getAll(){
        $sql = "SELECT * FROM users WHERE role != 'admin'";
        return $this->pdo->fetchAll($sql);
    }

    public function updateStatus(){
        $sql = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $this->pdo->execute($sql, [
            ':status' => $this->status,
            ':id' => $this->id
        ]);

        return (bool) $stmt;
    }

    public function delete(){
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->execute($sql, [
            ':id' => $this->id
        ]);
        return (bool) $stmt;
    }

}