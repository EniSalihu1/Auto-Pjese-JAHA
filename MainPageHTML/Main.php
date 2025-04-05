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
    <title>Auto Pjese JAHA</title>
    <link rel="stylesheet" href="../MainPageCss/Main.css">
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
            <?php if ($isLoggedIn && $role === 'admin'): ?>            
                <li><a href="dashboard.php">Dashboard</a></li>          
            <?php endif; ?>
            <li>
                <?php if ($isLoggedIn): ?>
                    <a href="logout.php" style="background-color: #f44336; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;" class="auth-button logout">
                        Log Out
                    </a>
                <?php else: ?>
                    <a href="login.php" style="background-color: #054442; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;" class="auth-button login">
                        Log In
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </header>

    <div class="container">
        <div class="welcome-message">
            <h1>Gjithçka që i duhet makinës tuaj, në një vend!</h1>
        </div>

        <div class="search-box">
            <input type="text" placeholder="Çfarë produkti po kërkoni?..." id="search" name="search">
            <button type="submit">Kërko</button>
        </div>
    </div>

    <!-- Footeri -->
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
                <h4>Na Ndiqni në faqen tone në:</h4>
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
