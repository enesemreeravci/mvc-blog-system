<?php

require_once __DIR__ . '/../../config/database.php';

class Category
{
    private PDO $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll();
    }

    public function create(string $name, string $slug): bool
    {
        $sql = "INSERT INTO categories (name, slug) VALUES (:name, :slug)";
        $stmt = $this->conn->prepare($sql);
        
        return $stmt->execute([
            ':name' => $name,
            ':slug' => $slug
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }
}