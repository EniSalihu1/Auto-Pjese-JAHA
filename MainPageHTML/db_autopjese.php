<?php

class db_autopjese{

    private $host ='localhost';
    private $dbname = 'autopjese_jaha';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function __construct(){

        try{
            
            $this ->conn = new PDO(dsn:"mysql:host ={$this->host}; dbname={$this->dbname}", username: $this->username, password:$this->password);
            $this ->conn -> setAttribute(attribute: PDO ::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e){

            die("Connection failed: " . $e->getMessage());
        }

    }
    public function getConnection(): PDO{

        return $this-> conn;
    }

}
/*Kodi qe e kom shkru un

// Krijo lidhjen me bazën e të dhënave
$conn = new mysqli($servername, $username, $password, $database);

// Kontrollo nëse ka ndodhur gabim në lidhje
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
*/
?>
