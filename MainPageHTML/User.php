<?php

    class User{

        private $conn;
        private $table_name = 'user';

        public function __construct($db) {
            $this-> conn = $db;
        }

       
        public function register($emri, $mbiemri, $email, $phone_number, $password, $confirm_password): bool {
            if ($password !== $confirm_password) {
                return false; 
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
                return false;
            }
        }

        public function login($email,$password) : bool {
            
            $query ="SELECT id, emri, mbiemri, email, phone_number, password FROM {$this->table_name} WHERE email = :email";
            $stmt = $this->conn->prepare($query);

            $stmt ->bindValue(':email', $email);           
           $stmt-> execute();
        
        
            if($stmt->rowCount() > 0){

                $row= $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($password, $row['password'])){
                    session_start();
                    $_SESSION['user_id'] =$row ['id'];
                    $_SESSION['email'] = $row['email'];
                    return true;
                }

            }
            return false;
        }

    }

?>