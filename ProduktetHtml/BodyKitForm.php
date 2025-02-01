<?php

session_start();

include_once 'db_products.php';
include_once 'db_BodyKit.php';

$isLoggedIn = isset($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new db_products();
    $connection = $db->getConnection();
    $user = new UserKlienti($connection);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if ($user->register($name, $email, $message)) {
        header("Location: Contact.php");
        exit;
    } else {
        echo "Error registering message!";
    }
}

class shtoBodyKit {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Funksioni për të shtuar një produkt të ri
    public function add($image, $titulli, $cmimi) {
        $this->validateImage($image); // Validimi i imazhit
        $imageName = $this->uploadImage($image); // Ngarkimi i imazhit
        $this->saveProduct($image, $titulli, $cmimi); // Ruajtja e të dhënave në databazë
    }

    // Validimi i imazhit
    private function validateImage($image) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image['type'], $allowedTypes)) {
            throw new Exception("Lejohen vetëm imazhe të tipit JPEG, PNG, ose GIF.");
        }
    }

    // Ngarkimi i imazhit në server
    private function uploadImage($image) {
        $targetDir = "../Images/"; // Drejtoria ku do të ruhen imazhet
        $imageName = basename($image['name']);
        $targetFilePath = $targetDir . $imageName;

        if (!move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            throw new Exception("Gabim gjatë ngarkimit të imazhit.");
        }

        return $imageName;
    }

    // Ruajtja e të dhënave në databazë
    private function saveProduct($image, $titulli, $cmimi) {
        $query = "INSERT INTO bodykitproduktet (image, titulli, cmimi) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$image, $titulli, $cmimi]);
    }

    // Funksioni për të marrë të gjitha produktet nga databaza
    public function getAllProducts() {
        $query = "SELECT * FROM bodykitproduktet ORDER BY id DESC"; // Merr të gjitha produktet, të renditura nga më i riu
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>