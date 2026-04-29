<?php

require_once __DIR__ . '/../../config/database.php';

class User
{
    private PDO $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create(string $username, string $email, string $password): bool
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password
        ]);
    }
}