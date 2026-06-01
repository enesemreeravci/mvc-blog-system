<?php

require_once __DIR__ . '/../../config/database.php';

class Post
{
    private PDO $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create(
        string $title,
        string $slug,
        string $content,
        string $excerpt,
        int $userId,
        string $status,
        ?int $categoryId
    ): bool {
        $sql = "INSERT INTO posts 
                (title, slug, content, excerpt, user_id, status, category_id)
                VALUES 
                (:title, :slug, :content, :excerpt, :user_id, :status, :category_id)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':title' => $title,
            ':slug' => $slug,
            ':content' => $content,
            ':excerpt' => $excerpt,
            ':user_id' => $userId,
            ':status' => $status,
            ':category_id' => $categoryId
        ]);
    }

    public function getPublished(): array
    {
        $sql = "SELECT posts.*, users.username, categories.name AS category_name
                FROM posts
                JOIN users ON posts.user_id = users.id
                LEFT JOIN categories ON posts.category_id = categories.id
                WHERE posts.status = 'published'
                ORDER BY posts.created_at DESC";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT posts.*, users.username, categories.name AS category_name
                FROM posts
                JOIN users ON posts.user_id = users.id
                LEFT JOIN categories ON posts.category_id = categories.id
                WHERE posts.id = :id
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        $post = $stmt->fetch();

        return $post ?: null;
    }

    public function update(
        int $id,
        string $title,
        string $content,
        string $excerpt,
        string $status,
        ?int $categoryId = null
    ): bool {
        $sql = "UPDATE posts
                SET title = :title,
                    content = :content,
                    excerpt = :excerpt,
                    status = :status,
                    category_id = :category_id
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':content' => $content,
            ':excerpt' => $excerpt,
            ':status' => $status,
            ':category_id' => $categoryId
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }

    public function findBySlug(string $slug): ?array
    {
        $sql = "SELECT posts.*, users.username, categories.name AS category_name
                FROM posts
                JOIN users ON posts.user_id = users.id
                LEFT JOIN categories ON posts.category_id = categories.id
                WHERE posts.slug = :slug 
                AND posts.status = 'published'
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':slug' => $slug]);

        $post = $stmt->fetch();

        return $post ?: null;
    }

    public function search(string $term): array
    {
        $sql = "SELECT posts.*, users.username, categories.name AS category_name
                FROM posts
                JOIN users ON posts.user_id = users.id
                LEFT JOIN categories ON posts.category_id = categories.id
                WHERE posts.status = 'published'
                AND (
                    posts.title LIKE :term 
                    OR posts.content LIKE :term 
                    OR users.username LIKE :term
                    OR categories.name LIKE :term
                )
                ORDER BY posts.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':term' => '%' . $term . '%']);

        return $stmt->fetchAll();
    }

    public function getPaginated(int $limit, int $offset): array
    {
        $sql = "SELECT posts.*, users.username, categories.name AS category_name
                FROM posts
                JOIN users ON posts.user_id = users.id
                LEFT JOIN categories ON posts.category_id = categories.id
                WHERE posts.status = 'published'
                ORDER BY posts.created_at DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function countPosts(): int
    {
        $sql = "SELECT COUNT(*) AS total 
                FROM posts 
                WHERE status = 'published'";

        $stmt = $this->conn->query($sql);
        $result = $stmt->fetch();

        return (int)$result['total'];
    }
}