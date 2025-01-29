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
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $password);

    if ($stmt->execute()) {
        header("Location: Login.php");
        exit();
    } else {
        echo "Gabim: " . $stmt->error;
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
    <title>Regjistrimi</title>
    <link rel="stylesheet" href="../MainPageCss/Register.Css">
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
        <form id="registerForm" action="../Index2.php/Register.php" method="POST">
            <div id="Hyrje">
                <img src="../Images/Logo.jpg" alt="">
                <h1>Register Here!</h1>
            </div>
            
            <div class="input-box1">
                <input type="text" id="fullname" name="fullname" placeholder="Emri" required>
                
            </div>
            
            <div class="input-box">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
    
            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
    
            <button type="submit" class="btn ">Register</button>
        </form>
    </div>
    <script src="script.js"></script>
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