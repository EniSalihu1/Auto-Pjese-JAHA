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

        <a href="./Main.html">
        <img src="../Images/Logo.jpg" alt="Logo">
    </a>
        <ul>
            <li><a href="../MainPageHTML/Produkt.html">Products</a></li>
            <li><a href="../MainPageHTML/AboutUs.html">About Us</a></li>
            <li><a href="../MainPageHTML/Contact.html">Contact Us</a></li>
            <?php if ($isLoggedIn): ?>
                <!-- When the user is logged in -->
                <li><button><a href="logout.php" id="LogOutButton">Log Out</a></button></li>
                <!-- Admin section -->
                
            <?php else: ?>
                <!-- When the user is not logged in -->
                <li><button><a href="login.php" id="LogInButton">Log In</a></button></li>
            <?php endif; ?>
            
        </div>
        </ul>
    </header>

    <div class="Hyrja">
        <h2>Zgjedheni kategorinë e juaj që jeni të interesuar !</h2>
    </div>
    <main>
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

    </main> 

    <div class="footer">

        <div class="footer-container">
            <div class="footer-section">
                <h4>Rreth Nesh</h4>
                <p>Ne ofrojmë pjesë cilësore për çdo lloj automjeti. Garantojmë cilësi dhe besueshmëri.</p>
            </div>
            
            <div class="footer-section">
                <h4>Na Kontaktoni </h4>
                <p>Email: info@autopjesa.com</p>
                <p>Tel: +383 44 296 081</p>
                <p>Adresa: Rruga Ferizajit Km 1, Gjilan</p>
            </div>
            <div class="footer-section social">
                <h4>Na Ndiqni ne faqen tone ne:</h4>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=100039106436166"><img src="../Images/Facebook.webp" alt="Facebook"></a>
                    </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 AutoPjesa. Të gjitha të drejtat e rezervuara.</p>
        </div>

    </div>
</div>
</body>
</html
