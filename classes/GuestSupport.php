<?php

include_once 'Database.php';
class GuestSupport
{
    private $conn;
    private $id;
    private $name;
    private $message;
    private $status;


    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function fetchById($id)
    {
        $query = "SELECT * FROM `guest_support` WHERE `guest_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchByTicket(string $ticket)
    {
        $query = "SELECT * FROM `guest_support` WHERE `ticket` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $ticket);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getExtension(array $file, $field_name)
    {
        switch ($file[$field_name]['type']) {
            case "image/pjpeg":
            case "image/jpeg":
                $extension = "jpg";
                break;
            case "image/png":
                $extension = "png";
                break;
            default:
                $extension = "";
                break;
        }
        return $extension;
    }

    public function fetchAll()
    { }

    public function insert(array $fields)
    {
        $query = "INSERT INTO `guest_support` SET ";

        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key, ";
        }

        //$query = rtrim($query, ',');
        $ticket = $this->generateTicket();
        $query .= "`ticket` = '$ticket' , `status` = 'Unread'";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        else return false;
    }



    public function update(Type $var = null)
    {
        # code...
    }



    public function closeSupport(Type $var = null)
    {
        # code...
    }


    public function generateTicket() : string
    {
        $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $ticket = "";
        for ($i = 0; $i <= 4; $i++) {
            $random = rand(0, strlen($string) - 1);
            $ticket .= substr($string, $random, 1);
        }

        $ticket = $ticket . rand(0, 9999999);
        if($this->checkTicket($ticket)) $this->generateTicket();
        else return $ticket;
    }

    public function checkTicket(string $str) : bool
    {
        $query = "SELECT `ticket` FROM `guest_support` WHERE `ticket` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $str);

        $stmt->execute();
        if($stmt->fetch(PDO::FETCH_ASSOC)) return true;
        else return false;
    }
}



// $test = new GuestSupport();
// print_r($test->generateTicket());
// echo "<pre>";
