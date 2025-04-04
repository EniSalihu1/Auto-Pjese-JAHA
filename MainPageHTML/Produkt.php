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
    <title>Produktet</title>
    <link rel="stylesheet" href="../MainPageCss/Products.css">
</head>
<body>
    <header class="nav">
        <a href="Main.php">
            <img src="../Images/Logo.jpg" alt="Logo">
        </a>
        <ul>
            <li><a href="../MainPageHTML/Main.php">Home</a></li>
            <li><a href="../MainPageHTML/News.php">News</a></li>
            <li><a href="../MainPageHTML/Produkt.php">Products</a></li>
            <li><a href="../MainPageHTML/AboutUs.php">About Us</a></li>
            <li><a href="../MainPageHTML/Contact.php">Contact Us</a></li>
            
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
                    <button style="background-color: #054442; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px;">
                        <a href="login.php" style="color: white; text-decoration: none;">Log In</a>
                    </button>
                <?php endif; ?>
            </li>
        </ul>
    </header>

    <div class="Hyrja">
        <h2>Zgjedheni kategorinë e juaj që jeni të interesuar !</h2>
    </div>

    <section class="filter-product-container">
        <div class="product-gallery">
            <div class="product">
                <a href="../MainPageHTML/BodyKit.php"><img src="../Images/Bodykit2.jpg" alt="BodyKit" width="90%"></a>
                <h3>Body Kit</h3>
            </div>
            <div class="product">
                <a href="../MainPageHTML/PjesetMotorrike.php"><img src="../Images/PjesetMotorrike.jpg" alt="PjesetMotorrike"></a>
                <h3>Pjesët Motorrike</h3>
            </div>
            <div class="product">
                <a href="../MainPageHTML/Detailing.php"><img src="../Images/Detailing.jpg" alt="Detailing" width="57%"></a>
                <h3>Detailing</h3>
            </div>
        </div>
    </section>

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
