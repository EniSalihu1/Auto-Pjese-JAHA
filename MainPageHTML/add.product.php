<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: LogIn.php');
    exit();
}

include '<db_products class=""></db_products>php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shto Produkt</title>
</head>
<body>
    <h1>Shto Produkt të Ri</h1>
    <form action="save_product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Emri i Produktit:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Përshkrimi:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="category">Kategoria:</label>
        <input type="text" id="category" name="category" required><br><br>

        <label for="image">Foto e Produktit:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <button type="submit">Shto Produktin</button>
    </form>
</body>
</html>