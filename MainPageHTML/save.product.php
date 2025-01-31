<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: LogIn.php');
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];


    $target_dir = "../Images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);


    $stmt = $conn->prepare("INSERT INTO products (name, description, image, category) VALUES (:name, :description, :image, :category)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $target_file);
    $stmt->bindParam(':category', $category);

    if ($stmt->execute()) {
        echo "Produkti u shtua me sukses!";
    } else {
        echo "Gabim gjatë shtimit të produktit.";
    }
}
?>