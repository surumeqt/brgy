<?php
require_once __DIR__ . '/../config/database.config.php';

class getModel {
    private $conn;

    public function __construct() {
        $db = new Connection();
        $this->conn = $db->connect();
    }

    // Get PDF blob by template ID
    public function getTemplateById($id) {
        $stmt = $this->conn->prepare("SELECT pdf_file, Hearing FROM GeneratedPDFs WHERE order_ID = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
}
