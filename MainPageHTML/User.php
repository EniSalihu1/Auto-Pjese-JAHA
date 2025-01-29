<?php

    class User{

        private $conn;
        private $table_name = 'user';

        public function __construct($db) {
            $this-> conn = $db;
        }

       
        public function register($emri, $mbiemri, $email, $phone_number, $password, $confirm_password) : bool {
            
            $query = "INSERT INTO {this->table_name} (emri, mbiemri, email, phone_number, password, confirm_password) VALUES (: emri,: mbiemri,: email,: phone_number,: password, : confirm_password)";
            $stmt = $this->conn->prepare($query);

            $stmt ->bindParam(': emri', $emri);
            $stmt ->bindParam(': mbiermi', $mbiemri);
            $stmt ->bindParam(': email', $email);
            $stmt ->bindParam(': phone_number', $phone_number);
            $stmt ->bindParam(': password', password_hash(password: $password, algo: PASSWORD_DEFAULT));
            $stmt ->bindParam(': confirm_password', password_hash(password: $confirm_password, algo: PASSWORD_DEFAULT));
        
            if($stmt-> execute()){

                return true;
            }
            return false;
        }

        public function login($email,$password) : bool {
            
            $query ="SELECT id, emri, mbiemri, email, phone_number, password, confirm_password FROM {$this->table_name} WHERE email = : email";
            $stmt = $this->conn->prepare($query);

            $stmt ->bindParam(': email', $email);           
           $stmt-> execute();
        
        
            if($stmt->rowCount() > 0){

                $row= $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify(password: $password, hash: $row['password'])){
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