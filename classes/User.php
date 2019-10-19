<?php

require_once 'Database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function add(array $fields): bool
    {
        $query = "INSERT INTO `users` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $password = password_hash('password', PASSWORD_DEFAULT);
        $query .= "`password` = '$password'";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function update($userId, array $fields): bool
    {
        $query = "UPDATE `users` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $query = rtrim($query, ',');
        $query .= " WHERE `id` = $userId";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function login(string $username, string $password)
    {
        $query = "SELECT * FROM `users` WHERE `username` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $verified = password_verify($password, $row['password']);
        if ($verified) {
            $id = $row['id'];
            $sql = "UPDATE `users` SET `login_at`= NOW() WHERE `id` = :id";
            $this->conn->prepare($sql)->execute(['id' => $id]);
            return $id;
        } else return false;
    }

    public function getUser($userId): array
    {
        $query = "SELECT * FROM `users` WHERE `id` = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":user_id", $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers(): array
    {
        $query = "SELECT * FROM `users` WHERE admin = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isAdmin($userId): bool
    {
        $query = "SELECT COUNT(*) FROM users where id = :userId and admin = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        if ($stmt->fetchColumn() == 1) return true;
        return false;
    }

    public function checkEmail(string $email, $userId = null): bool
    {
        $query = "";
        if ($userId != null) {
            $query = "SELECT * FROM users WHERE email = :email AND id != $userId";
        } else {
            $query = "SELECT * FROM users WHERE email = :email";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount()) return true;
        return false;
    }

    public function checkUsername(string $username, $userId = null): bool
    {
        $query = "";
        if ($userId != null) {
            $query = "SELECT * FROM users WHERE username = :username AND id != $userId";
        } else {
            $query = "SELECT * FROM users WHERE username = :username";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount()) return true;
        return false;
    }

    public function checkMobile(string $mobile, $userId = null): bool
    {
        $query = "";
        if ($userId != null) {
            $query = "SELECT * FROM users WHERE mobile = :mobile AND id != $userId";
        } else {
            $query = "SELECT * FROM users WHERE mobile = :mobile";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':mobile', $mobile);
        $stmt->execute();
        if ($stmt->rowCount()) return true;
        return false;
    }

    public function changePassword(array $fields): bool
    {
        $id = $fields['id'];
        $currentPassword = $fields['current_password'];
        $newPassword = password_hash($fields['new_password'], PASSWORD_DEFAULT);
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $varified = password_verify($currentPassword, $row['password']);
        if ($varified) {
            $query = "UPDATE users SET password = :new_password WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':new_password', $newPassword);
            if ($stmt->execute()) return true;
            return false;
        }
        return false;
    }
}