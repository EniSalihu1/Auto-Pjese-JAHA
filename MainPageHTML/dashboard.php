<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../ProduktetCss/dashboard.css">
</head>
<body>

<header class="nav">
    <a href="Main.php">
        <img src="../Images/Logo.jpg" alt="Logo">
    </a>
    <ul>
        <li><a href="Main.php">Home</a></li>
        <li><a href="News.php">News</a></li>
        <li><a href="Produkt.php">Products</a></li>
        <li><a href="AboutUs.php">About Us</a></li>
        <li><a href="Contact.php">Contact Us</a></li>

        <?php 

        if ($isLoggedIn && $role === 'admin'): ?>            
            <li><a href="dashboard.php">Dashboard</a></li>          
        <?php endif; ?>

        <li>
            <?php if ($isLoggedIn): ?>
             
                <button style="background-color: #f44336; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px;">
                    <a href="logout.php" style="color: white; text-decoration: none;">Log Out</a>
                </button>
            <?php else: ?>
         
                <button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px;">
                    <a href="login.php" style="color: white; text-decoration: none;">Log In</a>
                </button>
            <?php endif; ?>
        </li>
    </ul>
</header>

<div class="dashboard-container">
    <h1>Admin Dashboard</h1>

    <h2>Përdoruesit</h2>
    <a href="createUser.php"><button class="add-button">Shto Përdoruesin</button></a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Password</th>
                <th>Role</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>

        <?php
            $conn = new mysqli("localhost", "root", "", "autopjese_jaha");
            if ($conn->connect_error) {
                die("Lidhja dështoi: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM user";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: ". $conn->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['emri']}</td>
                        <td>{$row['mbiemri']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone_number']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['role']}</td>
                        <td>
                            <a href='editUser.php?id={$row['id']}'>Edito</a> | 
                            <a href='deleteUser.php?id={$row['id']}' onclick='return confirm(\"A je i sigurt?\")'>Fshij</a>
                        </td>
                    </tr>
                ";
            }
        ?>
        </tbody>
    </table>
</div>

<div class="dashboard-product">
    <h1>Produktet</h1>
    <a href="createProduct.php"><button class="add-button">Shto Produktin</button></a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imazhi</th>
                <th>Titulli</th>
                <th>Çmimi</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>

        <?php
            $conn = new mysqli("localhost", "root", "", "autopjese_jaha");

            if ($conn->connect_error) {
                die("Lidhja dështoi: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM bodykitproduktet";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td><img src='{$row['image']}' width='100' height='100'></td>
                            <td>{$row['titulli']}</td>
                            <td>{$row['cmimi']}€</td>
                            <td>
                                <a href='editProduct.php?id={$row['id']}'>Edito</a> | 
                                <a href='deleteProduct.php?id={$row['id']}' onclick='return confirm(\"A je i sigurt?\")'>Fshij</a>
                            </td>
                        </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='5'>Nuk ka produkte të regjistruara.</td></tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<div class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h4>Rreth Nesh</h4>
            <p>Ne ofrojmë pjesë cilësore për çdo lloj automjeti. Garantojmë cilësi dhe besueshmëri.</p>
        </div>
        <div class="footer-section">
            <h4>Na Kontaktoni</h4>
            <p>Email: info@autopjesa.com</p>
            <p>Tel: +383 44 296 081</p>
            <p>Adresa: Rruga Ferizajit Km 1, Gjilan</p>
        </div>
        <div class="footer-section social">
            <h4>Na Ndiqni ne faqen tone ne:</h4>
            <div class="social-icons">
                <a href="https://www.facebook.com/profile.html?id=100039106436166"><img src="../Images/Facebook.webp" alt="Facebook"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 AutoPjesa. Të gjitha të drejtat e rezervuara.</p>
    </div>
</div>

</body>
</html>
