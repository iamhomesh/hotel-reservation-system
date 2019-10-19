<?php

require_once __DIR__ . '/Database.php';

class Message
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function send(array $fields): bool
    {
        $query = "INSERT INTO messages SET ";
        foreach ($fields as $key => $value) {
            $query .= "$key = :$key, ";
        }
        $query = rtrim($query, ', ');
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM messages";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessage($messageId): array
    {
        $query = "SELECT * FROM messages where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $messageId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countMessages()
    {
        $now = date('Y-m-d h:i:s');
        $lastWeek = date('Y-m-d h:i:s', strtotime($now) - (60 * 60 * 24 * 7));
        $query = "SELECT COUNT(*) FROM messages WHERE CAST(created_at as DATE) BETWEEN '$lastWeek' AND '$now'";
        $stmt = $this->conn->query($query);
        return $stmt->fetchColumn();
    }

    public function getMessages()
    {
        $now = date('Y-m-d h:i:s');
        $lastWeek = date('Y-m-d h:i:s', strtotime($now) - (60 * 60 * 24 * 7));
        $query = "SELECT * FROM messages WHERE CAST(created_at as DATE) BETWEEN '$lastWeek' AND '$now' ORDER BY created_at DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}