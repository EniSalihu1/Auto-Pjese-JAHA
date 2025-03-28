<?php
session_start();

include_once 'db_products.php';
include_once 'UserKlienti.php';

$isLoggedIn = isset($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new db_products();
    $connection = $db->getConnection();
    $user = new UserKlienti($connection);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if ($user->register($name, $email, $message)) {
        header("Location: Contact.php");
        exit;
    } else {
        echo "Error registering message!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../MainPageCss/Contact.Css">
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
                    <button><a href="logout.php" id="LogOutButton">Log Out</a></button>
                <?php else: ?>
                    <button><a href="login.php" id="LogInButton">Log In</a></button>
                <?php endif; ?>
            </li>
        </ul>
    </header>
    <div class="container">
        <div class="left-section">
            <h2>Numri i Telefonit</h2>
            <p>044 915 780, 044 254 660</p>
            <h2>LOKACIONI</h2>
            <p>Rruga Ferizajit Km 1, Gjilan</p>
            <h2>Orari Punes</h2>
            <p>E Hene – E Shtune ..... 10 am – 8 pm<br>E Diele ...... Mbyllur</p>
        </div>
        <div class="right-section">
            <h2>CONTACT US</h2>
            <form id="ContactUs" action="Contact.php" method="POST">
                <input type="text" name="name" placeholder="name" required>
                <input type="email" name="email" placeholder="email" required>
                <textarea name="message" placeholder="message"></textarea>
                <button type="submit" class="btn">SUBMIT</button>
            </form>
        </div>
    </div>
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