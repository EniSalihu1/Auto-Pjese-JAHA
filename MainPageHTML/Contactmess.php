<?php
require_once "db_autopjese.php";

class Contact {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function saveMessage($name, $email, $phone, $message) {
        $stmt = $this->conn->prepare("INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $phone, $message]);
    }

    public function getMessages() {
        $stmt = $this->conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
