<?php
class UserKlienti {
    private $conn;
    private $table_name = 'bodykitproduktet';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($image, $titulli, $cmimi): bool {
        $query = "INSERT INTO {$this->table_name} (image, titulli, cmimi) VALUES (:image, :titulli, :cmimi)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':titulli', $titulli);
        $stmt->bindValue(':cmimi', $cmimi);

        return $stmt->execute();
    }
}
?>