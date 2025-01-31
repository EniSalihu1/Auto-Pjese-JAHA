<?php
class UserKlienti {
    private $conn;
    private $table_name = 'contact_messages';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($emri, $email, $message): bool {
        $query = "INSERT INTO {$this->table_name} (emri, email, message) VALUES (:emri, :email, :message)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':emri', $emri);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':message', $message);

        return $stmt->execute();
    }
}
?>