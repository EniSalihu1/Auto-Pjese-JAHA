<?php
include 'db.php';

$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktet</title>
</head>
<body>
    <h1>Produktet</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Emri</th>
            <th>Përshkrimi</th>
            <th>Kategoria</th>
            <th>Foto</th>
            <th>Veprimet</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['description']; ?></td>
            <td><?php echo $product['category']; ?></td>
            <td><img src="<?php echo $product['image']; ?>" width="100"></td>
            <td>
                <a href="delete_product.php?id=<?php echo $product['id']; ?>">Fshi</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>