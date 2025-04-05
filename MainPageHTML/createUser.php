<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "autopjese_jaha";

$conn = new mysqli($servername, $username, $password, $database);

$emri = "";
$mbiemri = "";
$email = "";
$phone_number = "";
$password = "";
$confirm_password = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $emri = $_POST["emri"];
    $mbiemri = $_POST["mbiemri"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    do {

        if (empty($emri) || empty($mbiemri) || empty($email) || empty($phone_number) || empty($password) || empty($confirm_password)) {
            $errorMessage = "All the fields are required";
            break;
        }

        if ($password !== $confirm_password) {
            $errorMessage = "Passwords do not match";
            break;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (emri, mbiemri, email, phone_number, password) VALUES ('$emri', '$mbiemri','$email','$phone_number','$hashedPassword')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $emri = "";
        $mbiemri = "";
        $email = "";
        $phone_number = "";
        $password = "";
        $confirm_password = "";

        $successMessage = "Client added correctly";

        header("location: dashboard.php"); 

    } while (false);
}

    $isLoggedIn = isset($_SESSION['user_id']);
    $role = $_SESSION['role'] ?? 'client';  
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreateUser</title>
    <link rel="stylesheet" href="../ProduktetCss/createUser.css">
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

        <li>
                <?php if ($isLoggedIn): ?> 
                    <a href="Login.php" style="font-family: 'Courier New', Courier, monospace; background-color: #054442; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;" class="auth-button logout">
                        Log In
                    </a>
                <?php else: ?>
                    <a href="Logout.php" style="font-family: 'Courier New', Courier, monospace; background-color: #f44336; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;" class="auth-button login">
                        Log Out
                    </a>
                <?php endif; ?>
            </li>
    </ul>
</header>



    <div class="container">
        <h2>New Client</h2>
   
        <?php if (!empty($errorMessage)): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-box">
                <input type="text" name="emri" placeholder="Emri" required value="<?php echo $emri; ?>">
            </div>

            <div class="input-box">
                <input type="text" name="mbiemri" placeholder="Mbiemri" required value="<?php echo $mbiemri; ?>">
            </div>

            <div class="input-box">
                <input type="email" id="email" name="email" placeholder="Email" required value="<?php echo $email; ?>">
            </div>

            <div class="input-box">
                <input type="text" id="phone_number" name="phone_number" placeholder="Numri i telefonit" required value="<?php echo $phone_number; ?>">
            </div>

            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Password" required value="<?php echo $password; ?>">
            </div>

            <div class="input-box">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required value="<?php echo $confirm_password; ?>">
            </div>

            <div class="input-box">
                <button type="submit" class="btn">Submit</button>
            </div>

            <div class="input-box">
                <button type="button" class="btn" onclick="window.location.href='dashboard.php'">Cancel</button>
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
