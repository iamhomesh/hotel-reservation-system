<?php

require_once 'Database.php';

class Guest
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function register(string $name, string $email, string $mobile, string $password): bool
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `guests` SET `name` = :name, `email` = :email, `mobile` = :mobile, `password` = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindvalue(':name', $name);
        $stmt->bindvalue(':email', $email);
        $stmt->bindvalue(':mobile', $mobile);
        $stmt->bindvalue(':password', $password);
        if ($stmt->execute()) return true;
        return false;
    }

    public function checkEmail(string $email, $guestId = null): bool
    {
        $query = "";
        if ($guestId != null) {
            $query = "SELECT COUNT(*) FROM guests WHERE email = :email AND id != $guestId";
        } else {
            $query = "SELECT COUNT(*) FROM guests WHERE email = :email";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) return true;
        return false;
    }

    public function checkMobile(string $mobile, $guestId = null): bool
    {
        $query = "";
        if ($guestId != null) {
            $query = "SELECT COUNT(*) FROM guests WHERE mobile = :mobile AND id != $guestId";
        } else {
            $query = "SELECT COUNT(*) FROM `guests` WHERE `mobile` = :mobile";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":mobile", $mobile);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) return true;
        return false;
    }

    public function changePassword($guestId, string $curr, string $new): bool
    {
        $query = "SELECT * FROM guests WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $guestId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $verified = password_verify($curr, $row['password']);
        if ($verified) {
            $new = password_hash($new, PASSWORD_DEFAULT);
            $query = "UPDATE guests SET password = :password WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $guestId);
            $stmt->bindValue(':password', $new);
            if ($stmt->execute()) return true;
            return false;
        }
        return false;
    }

    public function getGuest($guestId): array
    {
        $query = "SELECT * FROM `guests` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guestId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getName($guestId)
    {
        $query = "SELECT `name` FROM `guests` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guestId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getEmail($guestId)
    {
        $query = "SELECT `email` FROM `guests` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guestId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function update($guestId, array $fields): bool
    {
        $query = "UPDATE `guests` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $query = rtrim($query, ',');
        $query .= " WHERE `id` = $guestId";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function resetPassword(string $email, string $password): bool
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE guests SET password = :password WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $hashed);
        if ($stmt->execute()) return true;
        return false;
    }

    public function getAllGuests(): array
    {
        $query = "SELECT * FROM `guests`";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(array $fields): bool
    {
        $query = "INSERT INTO `guests` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $password = password_hash('password', PASSWORD_DEFAULT);
        $query .= "`password`= '$password'";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function login(string $email, string $password)
    {
        $query = "SELECT * FROM guests WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $row['id'];
        $verified = password_verify($password, $row['password']);
        if ($verified) {
            $stmt = $this->conn->prepare("UPDATE guests SET login_at = NOW() WHERE id = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $id;
        }
        return false;
    }
}