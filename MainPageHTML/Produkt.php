<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$role = $_SESSION['role'] ?? 'client'; // Merr rolin e përdoruesit
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
            <li><a href="../MainPageHTML/Produkt.php">Products</a></li>
            <li><a href="../MainPageHTML/AboutUs.php">About Us</a></li>
            <li><a href="../MainPageHTML/Contact.php">Contact Us</a></li>
            <?php if ($isLoggedIn): ?>
                <!-- Kur përdoruesi është i loguar -->
                <li><button><a href="logout.php" id="LogOutButton">Log Out</a></button></li>
            <?php else: ?>
                <!-- Kur përdoruesi nuk është i loguar -->
                <li><button><a href="login.php" id="LogInButton">Log In</a></button></li>
            <?php endif; ?>
        </ul>
    </header>

    <div class="Hyrja">
        <h2>Zgjedheni kategorinë e juaj që jeni të interesuar !</h2>
    </div>

    <main>
        <!-- Butoni për adminin për të shtuar produkte -->
        <?php if ($role === 'admin'): ?>
            <div class="add-button-container">
                <button class="add-news-btn" onclick="toggleForm()"> + Shto Produkt</button>

                <!-- Forma për shtimin e produkteve (e fshehur fillimisht) -->
                <form id="product-form" action="add_product.php" method="POST" enctype="multipart/form-data" style="display: none;">
                    <label for="image">Imazhi:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>

                    <label for="titulli">Titulli:</label>
                    <input type="text" id="titulli" name="titulli" required>

                    <label for="cmimi">Çmimi:</label>
                    <input type="text" id="cmimi" name="cmimi" required>

                    <button type="submit">Shto Produktin</button>
                </form>
            </div>
        <?php endif; ?>

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

    <script>
        // Funksioni për të shfaqur/fshehur formën
        function toggleForm() {
            const form = document.getElementById('product-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>