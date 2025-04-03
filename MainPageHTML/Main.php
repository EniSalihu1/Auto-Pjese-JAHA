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
    <link rel="stylesheet" href="../MainPageCss/Main.Css">
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
            $isLoggedIn = isset($_SESSION['isLoggedIn']) ? $_SESSION['isLoggedIn'] : false;
            $role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
            if ($isLoggedIn && $role === 'admin'): ?>            
                <li><a href="dashboard.php">Dashboard</a></li>          
            <?php endif; ?>
            <?php if ($isLoggedIn): ?>            
                <li><button><a href="logout.php" id="LogOutButton">Log Out</a></button></li>          
            <?php else: ?>
                <li><button><a href="login.php" id="LogInButton">Log In</a></button></li>
            <?php endif; ?>
        </ul>
    </header>

    <div class="container">
        <div class="welcome-message">
            <h1>Gjithçka që i duhet makinës tuaj, në një vend!</h1>
        </div>

        <div class="search-box" style="text-align: center; margin-bottom: 20px;">
            <input type="text" placeholder="Çfarë produkti po kërkoni?..." id="search" name="search">
            <button type="submit">Kërko</button>
        </div>
    </div>

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
