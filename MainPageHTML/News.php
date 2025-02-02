<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../MainPageCss/News.css">
    <title>News</title>
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
            <li>
                <?php if ($isLoggedIn): ?>
                <button><a href="logout.php" id="LogOutButton">Log Out</a></button>
                 <?php else: ?>
                <button><a href="login.php" id="LogInButton">Log In</a></button>
                <?php endif; ?>
            </li>
            
        </ul>
    </header>


    <section class="slider">
        <div class="slider-container">
   
          <div class="slide">
            <img src="../Images/TeknologjiteEReja.jpg" alt="Car Engine">
            <h2>Teknologjia e re në motorë elektrikë</h2>
            <p>Industria e automobilave po evoluon vazhdimisht, dhe motoret elektrike nuk bejne perjashtim. 
                Levizshmeria elektrike sapo ka ardhur, dhe ajo ende mund te evoluoje shume. 
                Ne fakt, ato tashme ekzistojne disa teknologji dhe tendenca qe tregon ky sektor i cili synon te zevendesoje te gjithe motoret me djegie te brendshme ne te ardhmen e afert.</p>
            <a href="https://sq.actualidadmotor.com/trendet-e-teknologjis%C3%AB-automjetet-elektrike/">Lexo më shumë</a>
          </div>
  
          <div class="slide">
            <img src="../Images/Sistemet e frenimit më të sigurta.jpg" alt="Brake System">
            <h2>Sistemet e frenimit më të sigurta</h2>
            <p>Sistemi i frenimit është një pjesë e rëndësishme e automjeteve, e cila ndikon në sigurinë e tyre në rrugë.
                 Këtu janë disa gjëra që duhet të keni parasysh në lidhje me kujdesin e sistemit të frenimit. </p>
            <a href="https://pjesekembimi24.al/sistemi-i-frenimit/">Lexo më shumë</a>
          </div>
        
          <div class="slide">
            <img src="../Images/Gomat më të mira për sezonin e dimrit.webp" alt="Tires">
            <h2>Gomat më të mira për sezonin e dimrit</h2>
            <p>Makina dhe rruga kontaktin e parë mes vete e bëjnë përmes gomave, andaj edhe shumë më e rëndësishmë është gjendja e gomave të makinës për një vozitje të sigurt.</p>
            <a href="https://www.autoshkolla-ks.com/artikujt/gomat-e-dimrit-ligji-dhe-cilat-jane-me-te-mira-te-ngushta-apo-te-gjera">Lexo më shumë</a>
          </div>
        </div>

          <!-- Butonat -->
  
          <button class="prev">❮</button>
          <button class="next">❯</button>
  
    </section>
        


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
    
    <script src="../MainPageJS/News.js"></script>
</body>
</html>