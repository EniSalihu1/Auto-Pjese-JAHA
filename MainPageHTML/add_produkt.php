<?php
session_start();

// Kontrollo nëse përdoruesi është admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Ju nuk keni leje për të kryer këtë veprim.");
}

include_once 'db_produktet.php'; // Përfshi lidhjen me bazën e të dhënave

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulli = $_POST['titulli'];
    $cmimi = $_POST['cmimi'];
    $image = $_FILES['image'];

    // Ruaj imazhin në server
    $target_dir = "../Images/";
    $target_file = $target_dir . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $target_file);

    // Ruaj të dhënat në bazën e të dhënave
    $query = "INSERT INTO products (titulli, cmimi, image_path) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sds", $titulli, $cmimi, $target_file);

    if ($stmt->execute()) {
        header("Location: Produkt.php"); // Ridrejto pas shtimit
        exit;
    } else {
        echo "Gabim gjatë shtimit të produktit.";
    }
}
?>