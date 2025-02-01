<?php
session_start();
include_once 'db_autopjese.php';
include_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new db_autopjese();
    $connection = $db->getConnection();
    $user = new User($connection);

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kontrollo nëse logimi është i suksesshëm
    if ($user->login($email, $password)) {
        // Përdoruesi është loguar, ruajmë rolin në sesion
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $user->getUserRole($email); // Ruaj rolin nga tabela
        header("Location: Main.php");
        exit;
    } else {
        echo "Invalid login credentials!";
    }
}

    // Kontrollo nëse fushat e email-it dhe fjalëkalimit janë bosh
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error_message = "Ju keni gabuar përdoruesin ose fjalëkalimin. <a href='LogIn.php'>Kliko për të provuar prapë</a>";
    } else {
        $db = new db_autopjese();
        $connection = $db->getConnection();
        $user = new User(db: $connection);

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->login(email: $email, password: $password)) {
            // Vendos një cookie për 30 ditë
            setcookie("user_email", $email, time() + (86400 * 2), "/");

            // Ruaj email-in e përdoruesit në sesion
            $_SESSION['user'] = $email;

            // Ridrejto në faqen kryesore
            header("Location: Main.php");
            exit();
        } else {
            $error_message = "Invalid login credentials! <a href='LogIn.php'>Kliko për të provuar prapë</a>";
        }
    }

?>

>>>>>>> 20004f1348be1e9e84e5eb76e8f1803dc1b27a87
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Pjese JAHA</title>
    <link rel="stylesheet" href="../MainPageCss/LogIn.Css">
    <style>
        .error-message {
            background-color: #ffebee; /* Ngjyrë e kuqe e hapur */
            color: #c62828; /* Ngjyrë e kuqe e errët */
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #c62828;
            text-align: center;
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 20px auto;
        }
        .error-message a {
            color: #1565c0; /* Ngjyrë blu */
            text-decoration: none;
            font-weight: bold;
        }
        .error-message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
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
        </ul>
    </header>

    <?php if (!empty($error_message)): ?>
        <div class="error-message">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <div class="wrapper"> 
        <form action="Login.php" method="POST">
            <div id="Hyrje">
                <img src="../Images/Logo.jpg" alt="">
                <h1>Log In</h1>
            </div>

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="./ForgotPassword.php">Forgot password</a>
            </div>
            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? 
                    <a href="Register.php"> Register</a></p>
            </div>
        </form>
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
</body>
</html>
