
<?php

session_start();

include_once 'db_produktet.php';
include_once 'UserProduktet.php';

$isLoggedIn = isset($_SESSION['user_id']);
$role = $_SESSION['role'] ?? 'client';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $role === 'admin') {
    $db = new db_produktet();
    $connection = $db->getConnection();
    $user = new shtoBodyKit($connection);

    $image = $_FILES['image'];
    $titulli = $_POST['titulli'];
    $cmimi = $_POST['cmimi'];

    try {
        $user->add($image, $titulli, $cmimi);
        header("Location: Produkt.php");
        exit;
    } catch (Exception $e) {
        echo "Gabim: " . $e->getMessage();
    }
}


class shtoBodyKit {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

 
    public function add($image, $titulli, $cmimi) {
        $this->validateImage($image);  
        $imageName = $this->uploadImage($image);  
        $this->saveProduct($image, $titulli, $cmimi);  
    }

    
    private function validateImage($image) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image['type'], $allowedTypes)) {
            throw new Exception("Lejohen vetëm imazhe të tipit JPEG, PNG, ose GIF.");
        }
    }
 
    private function uploadImage($image) {
        $targetDir = "../Images/";  
        $imageName = basename($image['name']);
        $targetFilePath = $targetDir . $imageName;

        if (!move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            throw new Exception("Gabim gjatë ngarkimit të imazhit.");
        }

        return $imageName;
    }
 
    private function saveProduct($image, $titulli, $cmimi) {
        $query = "INSERT INTO produkteteshtuara (image, titulli, cmimi) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$image, $titulli, $cmimi]);
    }

 
    public function getAllProducts() {
        $query = "SELECT * FROM produkteteshtuara ORDER BY id DESC";  
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>