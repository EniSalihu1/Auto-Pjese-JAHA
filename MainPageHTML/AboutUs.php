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
  <title>Rreth Nesh</title>
  <link rel="stylesheet" href="../MainPageCss/AboutUs.css">
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
     
        if ($isLoggedIn && $role === 'admin'): 
        ?>            
            <li><a href="dashboard.php">Dashboard</a></li>          
        <?php endif; ?>
        
        <li>
            <?php if ($isLoggedIn): ?>
        
            <button style="background-color: #f44336; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; text-align: center;">
                <a href="logout.php" style="color: white; text-decoration: none;">Log Out</a>
            </button>
            <?php else: ?>
           
            <button style="background-color: #054442; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; text-align: center;">
                <a href="login.php" style="color: white; text-decoration: none;">Log In</a>
            </button>
            <?php endif; ?>
        </li>
    </ul>
  </header>

  <section class="about-us">
    <div class="container">
      <h1>About Us</h1>
      <p>
        Mirë se vini në AutoPjesë JAHA, dyqani juaj me një ndalesë për pjesët dhe aksesorët e makinave me cilësi të lartë. 
        Ne jemi të specializuar në ofrimin e produkteve të nivelit të lartë që mbajnë automjetin tuaj në funksionim të qetë.
      </p>
      <p>
        Me më shumë se një dekadë përvojë, ekipi ynë është i përkushtuar për të ofruar shërbim të jashtëzakonshëm, 
        Çmime konkurruese, dhe një gamë të gjerë të markave të besuara. Nëse je profesionist 
        Mekanik apo entuziast makinash, të kemi mbuluar.
      </p>
      <div class="highlights">
        <div class="highlight">
          <h3>Cilësia e garantuar</h3>
          <p>Ne kemi vetëm produkte nga prodhues të besueshëm.</p>
        </div>
        <div class="highlight">
          <h3>Transporti i shpejtë</h3>
          <p>Merrni pjesët tuaja të dorëzuara shpejt, kudo që të jeni.</p>
        </div>
        <div class="highlight">
          <h3>Mbështetja e klientit</h3>
          <p>Ekipi ynë është këtu për t'ju ndihmuar me çdo pyetje apo shqetësim.</p>
        </div>
      </div>
    </div>
  

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
    
  </section>
</body>
</html>
