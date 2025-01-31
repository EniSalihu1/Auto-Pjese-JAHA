<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: LogIn.php');
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fshi produktin nga baza e të dhënave
    $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Produkti u fshi me sukses!";
    } else {
        echo "Gabim gjatë fshirjes së produktit.";
    }
}
header('Location: products.php'); // Ridrejto pas fshirjes
?>