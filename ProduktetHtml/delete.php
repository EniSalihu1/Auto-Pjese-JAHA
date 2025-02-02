<?php
session_start();

require_once 'db_produktet.php';
require_once 'UserProduktet.php';

$database = new db_produktet();
$pdo = $database->getConnection();
$userProduktet = new UserProduktet($pdo);

$id = $_GET['id'] ?? null;
if ($id && $userProduktet->delete($id)) {
    header("Location: Produkt.php?success=1");
    exit();
} else {
    echo "Error deleting product!";
}
?>