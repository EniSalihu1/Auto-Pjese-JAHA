<?php
session_start();
/*include_once 'db_autopjese.php';

// Kontrollo nëse përdoruesi është admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Nuk keni akses për këtë faqe!");
}

// Lidhu me databazën
$db = new db_autopjese();
$conn = $db->getConnection();

if (!$conn) {
    die("Gabim në lidhjen me databazën: " . $conn->connect_error);
}

// **SHTIMI I PRODUKTIT**
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';

    if (empty($name) || empty($description) || empty($category)) {
        die("Gabim: Të gjitha fushat duhet të plotësohen!");
    }

    // Ruajtja e fotos
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = basename($_FILES["image"]["name"]);
        $imagePath = $targetDir . $imageName;

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            die("Gabim në ngarkimin e fotos!");
        }
    } else {
        die("Gabim: Nuk u dërgua asnjë foto!");
    }

    // Shto produktin në databazë
    $query = "INSERT INTO produktet (name, description, category, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Gabim në prepare(): " . $conn->error);
    }

    if (!isset($imagePath) || empty($imagePath)) {
        die("Gabim: Nuk u gjet asnjë foto!");
    }

    $stmt->bind_param("ssss", $name, $description, $category, $imagePath);

    if ($stmt->execute()) {
        header("Location: produkt_admin.php");
        exit();
    } else {
        die("Gabim në ekzekutimin e query-t: " . $stmt->error);
    }
}

// **FSHIRJA E PRODUKTIT**
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

    $query = "DELETE FROM produktet WHERE id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Gabim në prepare(): " . $conn->error);
    }

    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        header("Location: produkt_admin.php");
        exit();
    } else {
        die("Gabim në fshirjen e produktit: " . $stmt->error);
    }
}

// **MERR PRODUKTET NGA DATABASE**
$query = "SELECT * FROM produktet";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menaxhimi i Produkteve</title>
</head>
<body>
    <h1>Menaxho Produktet</h1>

    <h2>Shto Produkt të Ri</h2>
    <form action="produkt_admin.php" method="POST" enctype="multipart/form-data">
        <label for="name">Emri i Produktit:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Përshkrimi:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="category">Kategoria:</label>
        <input type="text" id="category" name="category" required><br><br>

        <label for="image">Foto e Produktit:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <button type="submit" name="add_product">Shto Produktin</button>
    </form>

    <h2>Lista e Produkteve</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Emri</th>
            <th>Përshkrimi</th>
            <th>Kategoria</th>
            <th>Foto</th>
            <th>Veprime</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><img src="<?php echo $row['image']; ?>" width="100"></td>
            <td>
                <form action="produkt_admin.php" method="POST" style="display:inline;">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete_product">Fshij</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
