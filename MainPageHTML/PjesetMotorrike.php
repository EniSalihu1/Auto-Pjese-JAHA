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
    <title>Pjeset Motorrike</title>
    <link rel="stylesheet" href="../ProduktetCss/PjesetMotorrike.Css">
</head>
<body>
    <!-- Nav -->
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

<main class="products-section">
    
    <div class="Hyrja">
        <h1>Produktet e pranishme: </h1>
    </div>
    <div class="product-grid">
      
        <div class="product-item">
            <img src="../Images/Produkti10PM.webp" alt="Product 1">
            <h2> Radiator</h2>
            <p>79.99€</p>
           
        </div>
        <div class="product-item">
            <img src="../Images/Produkti11PM.webp" alt="Product 2">
            <h2>Disqe </h2>
            <p>99.99€</p>
            
        </div>
        <div class="product-item">
            <img src="../Images/Produkti12PM.webp" alt="Product 3" >
            <h2>Gurtne</h2>
            <p>39.99€</p>
             
        </div>
        <div class="product-item">
            <img src="../Images/Produkti13PM.webp" alt="Product 4">
            <h2>Alternatori</h2>
            <p>69.99€</p>
             
        </div>
        <div class="product-item">
            <img src="../Images/Produkti14PM.webp" alt="Product 5">
            <h2>Pompe e Ujit</h2>
            <p>109.99€</p>
          
        </div>
        <div class="product-item">
            <img src="../Images/Produkti15PM.webp" alt="Product 6" >
            <h2>Termostat</h2>
            <p>149.99€</p>
        
        </div>
        <div class="product-item">
            <img src="../Images/Produkti16PM.webp" alt="Product 7">
            <h2>Starter</h2>
            <p>54.99€</p>
          
        </div>
        <div class="product-item">
            <img src="../Images/Produkti17PM.webp" alt="Product 8">
            <h2>Filter i Vajit</h2>
            <p>14.99€</p>
           
        </div>
        <div class="product-item">
            <img src="../Images/Produkti18PM.webp" alt="Product 9">
            <h2>Filter i Klimes</h2>
            <p>9.99€</p>
            
        </div>
        <div class="product-item">
            <img src="../Images/Produkti19PM.webp" alt="Product 10">
            <h2>Filter i Ajrit</h2>
            <p>19.99€</p>
           
        </div>
        <div class="product-item">
            <img src="../Images/Produkti20PM.webp" alt="Product 11">
            <h2>Vaj i Motorrit</h2>
            <p>8.99€</p>
          
        </div>
        <div class="product-item">
            <img src="../Images/Produkti21PM.webp" alt="Product 12">
            <h2>Armotizera</h2>
            <p>179.99€</p>
            
        </div>
    </div>
</main>

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


<!-- Footer -->
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