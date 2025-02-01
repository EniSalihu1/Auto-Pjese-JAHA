<?php

class User {
    private $conn;
    private $table_name = 'user';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($emri, $mbiemri, $email, $phone_number, $password, $confirm_password): bool {
        if ($password !== $confirm_password) {
            throw new Exception("Fjalëkalimet nuk përputhen.");
        }

        $query = "INSERT INTO {$this->table_name} (emri, mbiemri, email, phone_number, password) VALUES (:emri, :mbiemri, :email, :phone_number, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':emri', $emri);
        $stmt->bindValue(':mbiemri', $mbiemri);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phone_number', $phone_number);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Gabim gjatë regjistrimit.");
        }
    }

    public function login($email, $password): bool {
        $query = "SELECT id, emri, mbiemri, email, phone_number, password FROM {$this->table_name} WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                return true;
            }
        }
        return false;
    }

    public function getUserRole($email) {
        return 'client';  // Kthe një vlerë default pa u bazuar në bazën e të dhënave
    }
}
?>