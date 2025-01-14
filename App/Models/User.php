<?php

class User{

    private Database $pdo;
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role;

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

    public function getPending(){
        $sql = "SELECT * FROM users WHERE status = 'pending'";
        return $this->pdo->fetchAll($sql);
    }

}