<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$role = $_SESSION['role'] ?? 'client';  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BodyKit</title>
    <link rel="stylesheet" href="../ProduktetCss/BodyKit.css">  
</head>
<body>

<!-- Nav -->
<header class="nav">
    <a href="./Main.html">
        <img src="../Images/Logo.jpg" alt="Logo">
    </a>
    <ul>
        <li><a href="Main.php">Home</a></li>
        <li><a href="News.php">News</a></li>
        <li><a href="Produkt.php">Products</a></li>
        <li><a href="AboutUs.php">About Us</a></li>
        <li><a href="Contact.php">Contact Us</a></li>
        <?php
        $isLoggedIn = isset($_SESSION['isLoggedIn']) ? $_SESSION['isLoggedIn'] : false;
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
        if ($isLoggedIn && $role === 'admin'): ?>            
                <li><a href="dashboard.php">Dashboard</a></li>          
            <?php endif; ?>
        <li>
            <?php if ($isLoggedIn): ?>
                <button><a href="logout.php" id="LogOutButton">Log Out</a></button>
            <?php else: ?>
                <button><a href="login.php" id="LogInButton">Log In</a></button>
            <?php endif; ?>
        </li>
    </ul>
</header>

<main class="products-section">

    <div class="Hyrja">
        <h1>Produktet e pranishme:</h1>
    </div>

 
    <div class="product-grid">
        <div class="product-item">
            <img src="../Images/Produkt1.webp" alt="Product 1">
            <h2>M3 Style Body Kit për BMW 3 Series</h2>
            <p>399.99€</p>
        </div>
        <div class="product-item">
            <img src="../Images/Produkt2MRC.jpg" alt="Product 2">
            <h2>Body kit për Mercedes-Benz GLC Class</h2>
            <p>489.99€</p>
        </div>
        <div class="product-item">
            <img src="../Images/Produkt3Audi.webp" alt="Product 3">
            <h2>Body kit për Audi RS3 Viti 2020 Full Set</h2>
            <p>449.99€</p>
        </div>
        <div class="product-item">
            <img src="../Images/Produkt4Bmw.jpg" alt="Product 4">
            <h2>M5 Style Body Kit për BMW 5 Series</h2>
            <p>549.99€</p>
        </div>
        <div class="product-item">
            <img src="../Images/Produkt5MRC.jpg" alt="Product 5">
            <h2>Body kit për Mercedes-Benz S Class</h2>
            <p>499.99€</p>
        </div>
        <div class="product-item">
            <img src="../Images/Produkt6Audi.jpg" alt="Product 6">
            <h2>Body kit për Audi RS6 Viti 2022 Full Set</h2>
            <p>649.99€</p>
        </div>
        <div class="product-item">
            <img src="../Images/Produkti7BMW.jpg" alt="Product 7">
            <h2>BMW X7 Style Body Kit për vitin 2024</h2>
            <p>749.99€</p>
        </div>
        <div class="product-item">
            <img src="../Images/Produkti8BMW.webp" alt="Product 8">
            <h2>Body kit për Mercedes-Benz E-Class</h2>
            <p>699.99€</p>
        </div>
        <div class="product-item">
            <img src="../Images/Produkt9Audi.jpg" alt="Product 9">
            <h2>Body kit për Audi RSQ8 Viti 2021 Full Set</h2>
            <p>749.99€</p>
        </div>
    </div>

    <?php

$conn = new mysqli("localhost", "root", "", "autopjese_jaha");

if ($conn->connect_error) {
    die("Lidhja dështoi: " . $conn->connect_error);
}

// Merr produktet nga databaza
$sql = "SELECT * FROM bodykitproduktet";
$result = $conn->query($sql);
?>

<main class="products-section">

    <div class="product-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product-item">
                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['titulli']; ?>">
                <h2><?php echo $row['titulli']; ?></h2>
                <p><?php echo $row['cmimi']; ?>€</p>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php $conn->close(); ?>



   
<?php if ($role === 'admin'): ?>
    <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
        <a href="dashboard.php">
            <button style="
                background-color: #083a03; 
                color: white; 
                padding: 12px 20px; 
                border: none; 
                border-radius: 5px; 
                font-size: 16px; 
                cursor: pointer; 
                font-weight: bold; 
                transition: background-color 0.3s, transform 0.2s;
            " 
            onmouseover="this.style.backgroundColor='#0a5504'; this.style.transform='scale(1.05)';"
            onmouseout="this.style.backgroundColor='#083a03'; this.style.transform='scale(1)';">
                + Shto Produkt
            </button>
        </a>
    </div>
<?php endif; ?>

</main>
 

<!-- Footer -->
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
            <h4>Na Ndiqni në faqen tonë:</h4>
            <div class="social-icons">
                <a href="https://www.facebook.com/profile.php?id=100039106436166"><img src="../Images/Facebook.webp" alt="Facebook"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 AutoPjesa. Të gjitha të drejtat e rezervuara.</p>
    </div>
</div>

</body>
</html>
