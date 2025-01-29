<?php

session_start ();

// Lidhja me bazën e të dhënave
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autopjese_jaha";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Lidhja dështoi: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Përgatit dhe ekzekuto pyetjen SQL
    $sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Kontrollojmë nëse fjalëkalimi i dhënë përputhet me atë në bazën e të dhënave
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_fullname'] = $user['fullname'];

        // Ridrejto tek Main.html
        header("Location: ../MainPageHTML/Main.html");
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Email ose fjalëkalim i pasaktë!</p>";
    }
} else {
    echo "<p style='color: red; text-align: center;'>Email ose fjalëkalim i pasaktë!</p>";
}

    $stmt->close();
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Pjese JAHA</title>
    <link rel="stylesheet" href="../MainPageCss/LogIn.Css">
</head>
<body>
    <header class="nav">

        <a href="./Main.html">
        <img src="../Images/Logo.jpg" alt="Logo">
    </a>
        <ul>
            <li><a href="../MainPageHTML/Main.html">Home</a></li>
            <li><a href="../MainPageHTML/News.html">News</a></li>
            <li><a href="../MainPageHTML/Produkt.html">Products</a></li>
            <li><a href="../MainPageHTML/AboutUs.html">About Us</a></li>
            <li><a href="../MainPageHTML/Contact.html">Contact Us</a></li>
        </ul>
    </header>

    <div class="wrapper"> 
        <form action="../Login.php" method = "POST">
            <div id="Hyrje">

                <img src="../Images/Logo.jpg" alt="">
                <h1>Log In</h1>

            </div>
            
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" 
                required>
            </div>
            
            <div class="input-box">
                <input type="password" name="password" placeholder="Password"
                required>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me
                </label>
                <a href="./ForgotPassword.html">Forgot password</a>
            </div>
            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? 
                    <a href="./Register.php"> Register</a></p>
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
                        <a href="https://www.facebook.com/profile.php?id=100039106436166"><img src="../Images/Facebook.webp" alt="Facebook"></a>
                    </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 AutoPjesa. Të gjitha të drejtat e rezervuara.</p>
        </div>

    </div>


    
</body>
</html>