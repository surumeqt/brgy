<?php
require_once __DIR__ . '/../config/database.config.php';

class User {
    private $db;

    public function __construct() {
        $connection = new Connection();
        $this->db = $connection->connect();
    }

    public function findByEmail($email): mixed {
        $sql = "SELECT User_ID, User_Address, User_Password, Position, User_Name FROM users WHERE User_Address = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
