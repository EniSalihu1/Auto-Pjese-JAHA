<?php
$host = 'localhost';
$dbname = 'autopjese_jaha';
$username = 'root'; 
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lidhja me bazën e të dhënave dështoi: " . $e->getMessage());
}
?>
