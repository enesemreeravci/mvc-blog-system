<?php

require_once __DIR__ . '/../../config/database.php';


class Comment
{
    private PDO $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create(int $postId, int $userId, string $content) :bool
    {
        $sql = "INSERT INTO comments (post_id, user_id, content)
                VALUES (:post_id, :user_id, :content)";
            
        $stmt = $this->conn->prepare($sql);
       
        return $stmt->execute([
            ':post_id' => $postId,
            ':user_id' => $userId,
            ':content' => $content
        ]);
    }

    public function getByPostId(int $postId): array
    {
        $sql = "SELECT comments.*, users.username
            FROM comments
            JOIN users ON comments.user_id = users.id
            WHERE comments.post_id = :post_id
            ORDER BY comments.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':post_id' => $postId]);

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM comments WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $comment = $stmt->fetch();
        return $comment ?: null;
    }

    public function deleteComment(int $id): bool
    {
        $sql = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        
        return $stmt->execute(['id' => $id]);
    }
}