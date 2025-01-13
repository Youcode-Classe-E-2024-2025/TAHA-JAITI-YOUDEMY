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
    public function setEmail(string $email) {$this->email = $email;}
    public function setPassword(string $password) {$this->password = $password;}
    public function setRole(string $role) {$this->role = $role;}

    public function create(){
        $sql = 'INSER INTO users(name, email, password, role) VALUES (:name, :email, :pass, :role)';
        $stmt = $this->pdo->execute($sql, [
            ':name' => $this->name,
            ':email' => $this->email,
            ':pass' => $this->password,
            ':role' => $this->role
        ]);

        if ($stmt){
            return true;
        }
        return false;
    }

}