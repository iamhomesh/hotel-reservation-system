<?php

require_once 'Database.php';

class Bill
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    private function generateBillNo(): string
    {
        $billNo = "";
        for ($i = 0; $i < 5; $i++) {
            $billNo .= chr(rand(65, 90));
        }
        for ($i = 0; $i < 5; $i++) {
            $billNo .= chr(rand(48, 57));
        }
        $billNo = str_shuffle($billNo);
        if ($this->checkBillNo($billNo)) $this->generateBillNo();
        else return $billNo;
    }

    private function checkBillNo(string $billNo): bool
    {
        $query = "SELECT COUNT(id) FROM bills WHERE bill_no = :bill_no";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':bill_no', $billNo);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) return true;
        return false;
    }

    public function getBill($billId): array
    {
        $query = "SELECT * FROM bills WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $billId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM bills";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $fields): bool
    {
        $query = "INSERT INTO bills SET ";
        foreach ($fields as $key => $value) {
            $query .= "$key = :$key,";
        }
        $billNo = $this->generateBillNo();
        $query .= " bill_no = '$billNo'";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) {
            return true;
        }
        return false;
    }

    public function update($billId, array $fields): bool
    {
        $query = "UPDATE bills SET ";
        foreach ($fields as $key => $value) {
            $query .= "$key = :$key,";
        }
        $query = rtrim($query, ',');
        $query .= " WHERE id = $billId";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) {
            return true;
        }
        return false;
    }

    public function billBookingStatus($bookingId): bool
    {
        $query = "SELECT COUNT(*) FROM bills WHERE booking_id = :booking_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':booking_id', $bookingId);
        $stmt->execute();
        if ($stmt->fetchColumn() == 1) {
            return true;
        }
        return false;
    }
}