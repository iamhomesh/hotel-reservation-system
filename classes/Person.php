<?php

include_once '../Database.php';
abstract class Person
{
    protected $conn;
    protected $tableName;

    private $id;
    private $name;
    private $email;
    private $mobile;

    //Methods to be implemented by child classes
    //abstract public function setTableName();
    abstract public function login($username, $password);




    //this method must be called from child classes to set connection
    public function setConnection()
    {
        $pdo = new Database();
        $this->conn = $pdo->getConnection();
    }

    //method to get guest/user data
    public function getPerson($id)
    {

        if ($this->tableName == 'user') {
            $query = "SELECT * FROM `" . $this->tableName . "` WHERE `user_id` = :id";
        } elseif ($this->tableName == 'guest') {
            $query = "SELECT * FROM `" . $this->tableName . "` WHERE `guest_id` = :id";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function fetchById($id)
    {
        if ($this->tableName == 'user') {
            $query = "SELECT * FROM `" . $this->tableName . "` WHERE `user_id` = :id";
        } elseif ($this->tableName == 'guest') {
            $query = "SELECT * FROM `" . $this->tableName . "` WHERE `guest_id` = :id";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll()
    { }
}
