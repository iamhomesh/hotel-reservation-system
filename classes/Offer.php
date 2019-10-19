<?php

require_once __DIR__ . '/Database.php';

class Offer
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function add(array $fields): bool
    {
        $query = "INSERT INTO offers SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key, ";
        }
        $query = rtrim($query, ', ');
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function update($offerId, array $fields): bool
    {
        $query = "UPDATE offers SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $query = rtrim($query, ',');
        $query .= " WHERE `id` = $offerId";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function getOffer($offerId): array
    {
        $query = "SELECT * FROM offers WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $offerId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllOffers(): array
    {
        $query = "SELECT * FROM offers";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}