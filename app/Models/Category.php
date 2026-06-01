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

    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM categories WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        $category = $stmt->fetch();

        return $category ?: null;
    }

    public function update(int $id, string $name, string $slug): bool
    {
        $sql = "UPDATE categories SET name = :name, slug = :slug WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
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

    public function getWithPostCounts(): array
    {
        $sql = "SELECT categories.*, COUNT(posts.id) AS post_count
                FROM categories
                LEFT JOIN posts ON posts.category_id = categories.id
                GROUP BY categories.id
                ORDER BY categories.name ASC";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll();
    }
}