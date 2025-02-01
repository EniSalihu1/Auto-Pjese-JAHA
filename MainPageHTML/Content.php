<?php
require_once "db_autopjese.php";
/*
class Content {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function addContent($user_id, $title, $body, $image, $pdf, $category) {
        $stmt = $this->conn->prepare("INSERT INTO content (user_id, title, body, image, pdf, category) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $title, $body, $image, $pdf, $category]);
    }

    public function getContent($category) {
        $stmt = $this->conn->prepare("SELECT content.*, users.first_name, users.last_name FROM content JOIN users ON content.user_id = users.id WHERE category = ?");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
