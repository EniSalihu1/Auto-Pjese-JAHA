<?php
class UserProduktet {
    private $conn;
    private $table_name = 'produkteteshtuara';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Shto një produkt të ri
    public function create($image, $titulli, $cmimi): bool {
        $query = "INSERT INTO {$this->table_name} (image, titulli, cmimi) VALUES (:image, :titulli, :cmimi)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':titulli', $titulli);
        $stmt->bindValue(':cmimi', $cmimi);

        return $stmt->execute();
    }

    // Merr të gjitha produktet
    public function readAll(): array {
        $query = "SELECT * FROM {$this->table_name} ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Merr një produkt sipas ID
    public function readOne($id): ?array {
        $query = "SELECT * FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Përditëso një produkt
    public function update($id, $image, $titulli, $cmimi): bool {
        $query = "UPDATE {$this->table_name} SET image = :image, titulli = :titulli, cmimi = :cmimi WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':titulli', $titulli);
        $stmt->bindValue(':cmimi', $cmimi);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    // Fshi një produkt
    public function delete($id): bool {
        $query = "DELETE FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
?>