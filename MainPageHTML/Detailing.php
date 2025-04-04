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
    <title>Detailing</title>
    <link rel="stylesheet" href="../ProduktetCss/Detailing.Css">
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
                    <button style="background-color: #f44336; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;">
                        <a href="logout.php" style="color: white; text-decoration: none;">Log Out</a>
                    </button>
                <?php else: ?>
                    <button style="background-color: #054442; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;">
                        <a href="login.php" style="color: white; text-decoration: none;">Log In</a>
                    </button>
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
                <img src="../Images/Produkti22D.webp" alt="Product 1">
                <h2> Parfume</h2>
                <p>4.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkti23D.webp" alt="Product 2">
                <h2>Lecke Mikrofiber </h2>
                <p>24.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkti24D.webp" alt="Product 3">
                <h2>Sfungjer Mikrofiber</h2>
                <p>7.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkti25D.webp" alt="Product 4">
                <h2>Makine Poliri</h2>
                <p>69.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkti26D.webp" alt="Product 5">
                <h2>Shampon</h2>
                <p>4.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkt27D.webp" alt="Product 6">
                <h2>Restaurues plastike</h2>
                <p>4.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkti28D.jpg" alt="Product 7">
                <h2>Shkume per lekure</h2>
                <p>9.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkti29D.jpg" alt="Product 8">
                <h2>Brushë për pastrim </h2>
                <p>3.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkti30D.jpg" alt="Product 9">
                <h2>Furqe Pastrimi</h2>
                <p>1.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkti31D.jpg" alt="Product 10">
                <h2>Brushe per Fellne</h2>
                <p>19.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkti32.jpg" alt="Product 11">
                <h2>Shkelqyes Gomash</h2>
                <p>14.99€</p>
            </div>
            <div class="product-item">
                <img src="../Images/Produkti33D.jpg" alt="Product 12">
                <h2>Pastrues Xhami</h2>
                <p>3.99€</p>
            </div>
        </div>
    </main>

<?php if ($role === 'admin'): ?>
    <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
        <a href="dashboard.php">
            <button style="background-color: #083a03; color: white; padding: 12px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; font-weight: bold; transition: background-color 0.3s, transform 0.2s;">
                + Shto Produkt
            </button>
        </a>
    </div>
<?php endif; ?>

<script>
    function toggleForm() {
        const form = document.getElementById('news-form');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>

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
                <a href="https://www.facebook.com/profile.html?id=100039106436166">
                    <img src="../Images/Facebook.webp" alt="Facebook">
                </a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 AutoPjesa. Të gjitha të drejtat e rezervuara.</p>
    </div>
</div>
    
</body>
</html>
