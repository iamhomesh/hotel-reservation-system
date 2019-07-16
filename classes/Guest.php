<?php

include_once 'Database.php';

class Guest
{

    private $conn;
    private $id_card_no;
    private $address;
    private $city;
    private $state_id;


    public function __construct()
    {
        $this->setConnection();
    }

    public function setConnection()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }



    public function login($username, $password)
    {
        $query = "SELECT `guest_id`, `email`, `password` FROM `guest` WHERE `email` = ? AND `password` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['guest_id'];
        } else {
            return false;
        }
    }

    public function register($name, $email, $mobile, $password)
    {
        $query = "INSERT INTO `guest` SET `name` = :name, `email` = :email, `mobile` = :mobile, `password` = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindvalue(':name', $name);
        $stmt->bindvalue(':email', $email);
        $stmt->bindvalue(':mobile', $mobile);
        $stmt->bindvalue(':password', $password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function checkEmail($email)
    {
        $query = "SELECT `guest_id` FROM `guest` WHERE `email` = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkMobile($mobile)
    {
        $query = "SELECT `guest_id` FROM `guest` WHERE `mobile` = :mobile";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":mobile", $mobile);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function changePassword($id, $curr, $new)
    {
        $query = "SELECT COUNT(`guest_id`) FROM `guest` WHERE `guest_id` = :id AND `password` = :curr";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':curr', $curr);
        $stmt->execute();
        if ($stmt->fetchColumn() == 1) {
            $query = "UPDATE `guest` SET `password` = :new WHERE `guest_id` = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':new', $new);
            $stmt->bindValue(':id', $id);

            if ($stmt->execute()) return true;
            else return false;
        } else return false;
    }

    public function fetchData($id)
    {
        $query = "SELECT * FROM `guest` WHERE `guest_id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getName($guest_id)
    {
        $query = "SELECT `name` FROM `guest` WHERE `guest_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guest_id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function getEmail($guest_id)
    {
        $query = "SELECT `email` FROM `guest` WHERE `guest_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guest_id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }


    public function update($id, $fields)
    {

        $query = "UPDATE `guest` SET ";

        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }

        $query = rtrim($query, ',');
        $query .= " WHERE `guest_id` = $id";

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute($fields)) {
            return true;
        } else {
            return false;
        }
    }
}

//$fields = array('name' => 'Tested', 'mobile' => '000999000', 'email' => 'test@test.com', 'password' => 'test');
// $fields = array(
//     'name' => 'John Smith',
//     'mobile' => '1299999',
//     'email' => 'john@smith.com',
//     'id_card' => '129999',
//     'pin-code' => '12999',
//     'address' => 'Hollywood',
//     'city' => 'Pune',
//     'state_id' => '3'
// );

//  echo "<pre>";
//  print_r($fields);

//$guest = new Guest();

//$guest->update(3, $fields);
//echo $guest->getEmail(2);

