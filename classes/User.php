<?php

include_once 'Database.php';
class User
{
    private $conn;
    private $id;
    private $username;
    private $password;
    private $name;
    private $mobile;
    private $email;

    public function __construct()
    {
        //$this->conn = $pdo_object;
        $this->setConnection();
        //$this->tableName = 'user';
    }
    private function setConnection()
    {
        $pdo = new Database();
        $this->conn = $pdo->getConnection();
    }

    
    public function fixNames($name)
    {
        $name = strtolower(trim($name));
        $arrName = explode(' ', $name);
        $name = array();
        foreach($arrName as $value) {
            $name[] = ucfirst($value);
        }
         return implode(' ', $name);
    }

    
    
    public function getUser($id)
    {
        $query = "SELECT * FROM `user` WHERE `user_id` = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($username, $name, $mobile, $email, $password)
    {
        


        $query = "INSERT INTO `user` SET `name` = :name, `username` = :username, `mobile` = :mobile, `email` = :email, `password` = :password, `created` = :created";

        $stmt = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($name));
        $name = $this->fixNames($name);
        $username = htmlspecialchars(strip_tags($username));
        $mobile = htmlspecialchars(strip_tags($mobile));
        $email = htmlspecialchars(strip_tags($email));
        $password = htmlspecialchars(strip_tags($password));
        
        $created = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $created = $created->format('y-m-d H:i:s');

        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':mobile', $mobile);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':created', $created);

        $stmt->execute();
        
    }
    public function update()
    {
        
    }

    public function login($username, $password)
    {
        $this->username = htmlspecialchars(strip_tags($username));
        $this->password = htmlspecialchars(strip_tags($password));
        $query = "SELECT `username`, `password` FROM `user` WHERE `username` = ? AND `password` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->username);
        $stmt->bindValue(2, $this->password);
        $stmt->execute();
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);
        $row = $stmt->rowCount();
        if ($row == 1) {
            $sql = "UPDATE `user` SET `login`= NULL WHERE `username` = :username AND `password` = :password";
            $this->conn->prepare($sql)->execute(['username' => $this->username, 'password' => $this->password]);
            return true;
        }
            
        else
            return false;
    }

    public function fetchUserById($id)
    {
        
        $query = "SELECT * FROM `" . $this->tableName . "` WHERE `user_id` = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAllUsers()
    {
        $query = "SELECT * FROM `" . $this->tableName . "`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    

    
}
