<?php
session_start();

 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Ju nuk keni leje për të kryer këtë veprim.");
}

include_once 'db_produktet.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulli = $_POST['titulli'];
    $cmimi = $_POST['cmimi'];
    $image = $_FILES['image'];
 
    $target_dir = "../Images/";
    $target_file = $target_dir . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $target_file);

 
    $query = "INSERT INTO products (titulli, cmimi, image_path) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sds", $titulli, $cmimi, $target_file);

    if ($stmt->execute()) {
        header("Location: Produkt.php");  
        exit;
    } else {
        echo "Gabim gjatë shtimit të produktit.";
    }
}
?>