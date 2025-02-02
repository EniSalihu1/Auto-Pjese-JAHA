<?php
session_start();

require_once 'db_produktet.php';
require_once 'UserProduktet.php';

$database = new db_produktet();
$pdo = $database->getConnection();
$userProduktet = new UserProduktet($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $image = $_FILES['image']['name'];
    $titulli = $_POST['titulli'];
    $cmimi = $_POST['cmimi'];

    // Ngarko imazhin në server
    $target_dir = "../Images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Përditëso produktin
    if ($userProduktet->update($id, $image, $titulli, $cmimi)) {
        header("Location: Produkt.php?success=1");
        exit();
    } else {
        echo "Error updating product!";
    }
}

$id = $_GET['id'] ?? null;
$product = $userProduktet->readOne($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*">
         
        <label for="titulli">Titulli:</label>
        <input type="text" id="titulli" name="titulli" value="<?php echo htmlspecialchars($product['titulli']); ?>" required>

        <label for="cmimi">Cmimi:</label>
        <input type="text" id="cmimi" name="cmimi" value="<?php echo htmlspecialchars($product['cmimi']); ?>" required>

        <button type="submit">Update</button>
    </form>
</body>
</html>