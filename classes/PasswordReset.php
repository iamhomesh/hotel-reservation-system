<?php

require_once __DIR__ . '/Database.php';

class PasswordReset
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM password_reset_requests ORDER BY status, created_at DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPendings(): array
    {
        $query = "SELECT * FROM password_reset_requests WHERE status = 'Pending' ORDER BY created_at DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countPendings()
    {
        $query = "SELECT COUNT(*) FROM password_reset_requests WHERE status = 'Pending'";
        $stmt = $this->conn->query($query);
        return $stmt->fetchColumn();
    }

    public function send(string $email)
    {
        $token = $this->generateToken();
        $now = date('Y-m-d H:i:s');
        $expire = date('Y-m-d H:i:s', strtotime($now)  + (60 * 30));
        $query = "INSERT INTO password_resets SET email = :email, token = :token, expire_at = :expire";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':expire', $expire);
        $stmt->bindValue(':token', $token);
        if ($stmt->execute()) {
            if($this->sendMail($email, $token)) return true;
        } else return false;
    }

    private function generateToken(): string
    {
        $str = "";
        for ($i = 1; $i <= 30; $i++) $str .= chr(rand(65, 90));
        for ($i = 1; $i <= 40; $i++) $str .= chr(rand(48, 57));
        for ($i = 1; $i <= 30; $i++) $str .= chr(rand(97, 122));
        return str_shuffle($str);
    }

    public function getByToken(string $token)
    {
        $query = "SELECT * FROM password_resets WHERE token = :token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':token', $token);
        if ($stmt->execute()) return $stmt->fetch(PDO::FETCH_ASSOC);
        else return false;
    }

    private function sendMail(string $email, string $token)
    {
        $message =  $this->mailTemplate($email, $token);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: HMS <homver30@gmail.com>';
        return mail($email, 'Password Reset', $message, $headers);
    }

    private function mailTemplate(string $email, string $token)
    {
        $message = <<<MESSAGE
        <!DOCTYPE html>
        <html>
        <head>
            <title>Hotel Resevation System</title>
            <style>
                * {font-family: 'Roboto', sans-serif;}
                #link {
                    color: white;
                    font-weight: bold;
                    text-decoration: none;
                    background-color: salmon;
                    padding: .5em;
                
                }
                #link-outer{
                    margin-top: 50px;
                    margin-bottom: 50px;
                }
                #link:hover {
                    background-color: white;
                    color: salmon;
                    transition: 2s;
                    text-transform: uppercase;
                    border-bottom: 2px dotted red;
                }
            </style>
        </head>
        <body>
            <div>
                <div style="text-align:center">
                    <h2>Password Reset</h2>
                    <h4>Hello, <span style="font-style:italic">$email</span></h4>
                    <p>You recently requested to reset your password for HMS, click below link to reset.</p>
                    <div id="link-outer">
                        <a href="reset_password.php?token=$token" id="link"><span id="text">CLICK HERE TO RESET YOUR PASSWORD</span></a>
                    </div>
                    <p>If you did not requested for a password reset, please ignore this mail.</p>
                    <cite>Note: link will be expired in next 30 minutes.</cite>
                </div>
                <div>
                    <p>Thanks</p>
                    <p>HMS Team</p>
                </div>
                <div style="text-align:center; background-color: gray; padding:10px">
                    <h3>Hotel Name</h3>
                    <p>Raipur, Chhattisgarh - 492001</p>
                    <p>+91 98765 12345</p>
                </div>
            </div>
        </body>
        </html>
        MESSAGE;
        return $message;
    }
}
