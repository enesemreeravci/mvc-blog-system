<?php

class Database
{
    private string $host = "localhost";
    private string $db_name = "mvc_blog_system";
    private string $username = "blog_user";
    private string $password = "blog_password";
    private ?PDO $conn = null;

    public function connect(): PDO
    {
        if ($this->conn === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";

            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return $this->conn;
    }
}