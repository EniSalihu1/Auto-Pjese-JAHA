<?php

    class UserKlient{

        private $conn;
        private $table_name = 'contact_messages';

        public function __construct($db) {
            $this-> conn = $db;
        }
       
        public function getMessages($emri, $email, $message): bool {
            if ($password !== $confirm_password) {
                throw new Exception("Fjalëkalimet nuk përputhen.");
            }
        
            $query = "INSERT INTO {$this->table_name} (emri, email, message) VALUES (:emri, :email, :message)";
            $stmt = $this->conn->prepare($query);
        
            $stmt->bindValue(':emri', $emri);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':message', $message);
        
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Gabim gjatë regjistrimit.");
            }
        }

    }

?>