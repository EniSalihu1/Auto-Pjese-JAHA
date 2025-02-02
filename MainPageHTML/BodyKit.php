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
            <li>
                <?php if ($isLoggedIn): ?>
                    <button><a href="logout.php" id="LogOutButton">Log Out</a></button>
                <?php else: ?>
                    <button><a href="login.php" id="LogInButton">Log In</a></button>
                <?php endif; ?>
            </li>
        </ul>
    </header>

<!-- Permbajtja -->
<main class="products-section">

<?php if ($role === 'admin'): ?>
            <div class="add-button-container">
                <button class="Produkt.php" onclick="toggleForm()"> + Shto Produkt</button>
    <div class="Hyrja">
        <h1>Produktet e pranishme: </h1>
    </div>
    <div class="product-grid">
        <!-- Product Items -->
        <div class="product-item">
            <img src="../Images/Produkt1.webp" alt="Product 1">
            <h2>M3 Style Body Kit per BMW 3 Series</h2>
            <p>399.99€</p>
            
        </div>
        <div class="product-item">
            <img src="../Images/Produkt2MRC.jpg" alt="Product 2" width="82%">
            <h2>Body kit per Mercedes-Benz GLC Class</h2>
            <p>489.99€</p>
        
        </div>
        <div class="product-item">
            <img src="../Images/Produkt3Audi.webp" alt="Product 3" width="83%">
            <h2>Body kit per Audi RS3 Viti 2020 Full Set</h2>
            <p>449.99€</p>
            
        </div>
        <div class="product-item">
            <img src="../Images/Produkt4Bmw.jpg" alt="Product 4">
            <h2>M5 Style Body Kit per BMW 5 Series</h2>
            <p>549.99€</p>
           
        </div>
        <div class="product-item">
            <img src="../Images/Produkt5MRC.jpg" alt="Product 5">
            <h2>Body kit per Mercedes-Benz S Class</h2>
            <p>499.99€</p>
       
        </div>
        <div class="product-item">
            <img src="../Images/Produkt6Audi.jpg" alt="Product 6" width="92%">
            <h2>Body kit per Audi RS6 Viti 2022 Full Set</h2>
            <p>649.99€</p>
            
        </div>
        <div class="product-item">
            <img src="../Images/Produkti7BMW.jpg" alt="Product 7">
            <h2>BMW X7 Style Body Kit per vitin 2024</h2>
            <p>749.99€</p>
            
        </div>
        <div class="product-item">
            <img src="../Images/Produkti8BMW.webp" alt="Product 8">
            <h2>Body kit per Mercedes-Benz E-Class</h2>
            <p>699.99€</p>
          
        </div>
        <div class="product-item">
            <img src="../Images/Produkt9Audi.jpg" alt="Product 9">
            <h2>Body kit per Audi RSQ8 Viti 2021 Full Set</h2>
            <p>749.99€</p>
           
        </div>
    </div>
</main>

<!-- Butoni shto -->
<?php if ($role === 'admin'): ?>
    <div class="add-button-container">
        <button class="add-news-btn" onclick="toggleForm()"> +Shto Produkt</button>

        <form id="news-form" action="Produkt.php" method="POST" enctype="multipart/form-data" style="display: none;">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
     
            <label for="titulli">Titulli:</label>
            <input type="text" id="titulli" name="titulli" required>

            <label for="cmimi">Cmimi:</label>
            <input type="text" id="cmimi" name="cmimi" required>

            <button type="submit">Submit</button>
        </form>
    </div>
<?php endif; ?>

<script>
    function toggleForm() {
        const form = document.getElementById('news-form');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>


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