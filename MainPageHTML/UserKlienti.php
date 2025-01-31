<?php
class UserKlienti {
    private $conn;
    private $table_name = 'contact_messages';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($name, $email, $message): bool {
        $query = "INSERT INTO {$this->table_name} (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':message', $message);

        return $stmt->execute();
    }
}
?>