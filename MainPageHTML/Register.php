<?php
session_start();
include 'db_autopjese.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $role = 'user';

    // Kontrollo nëse fushat janë bosh
    if (empty($fullname) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
        exit;
    }

    // Ndarja e `fullname` në `name` dhe `surname`
    $nameParts = explode(" ", $fullname, 2);  // Përdorim 2 pjesë për të marrë vetëm emrin dhe mbiemrin

    if (count($nameParts) < 2) {
        echo "Please provide both name and surname.";
        exit;
    }

    $name = $nameParts[0];   // Emri
    $surname = $nameParts[1]; // Mbiemri

    // Validimi i email-it
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Kontrollo nëse fjalëkalimet përputhen
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Hashimi i fjalëkalimit
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Përgatitja e query-t të sigurtë për insert
    $stmt = $conn->prepare("INSERT INTO users (name, surname, email, password, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $surname, $email, $hashedPassword, $role);

    if ($stmt->execute()) {
        header("Location: Login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
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

        <a href="./Main.php">
        <img src="../Images/Logo.jpg" alt="Logo">
    </a>
        <ul>
            <li><a href="../MainPageHTML/Main.php">Home</a></li>
            <li><a href="../MainPageHTML/News.php">News</a></li>
            <li><a href="../MainPageHTML/Produkt.php">Products</a></li>
            <li><a href="../MainPageHTML/AboutUs.php">About Us</a></li>
            <li><a href="../MainPageHTML/Contact.php">Contact Us</a></li>
        </ul>
    </header>
    
    <div class="wrapper"> 
        <form id="registerForm" action="../Index2.php/Register.php" method="POST">
            <div id="Hyrje">
                <img src="../Images/Logo.jpg" alt="">
                <h1>Register Here!</h1>
            </div>
            
            <div class="input-box1">
    <input type="text" id="name" name="name" placeholder="Emri" required>
</div>

<div class="input-box1">
    <input type="text" id="surname" name="surname" placeholder="Mbiemri" required>
</div>

<div class="input-box">
    <input type="email" id="email" name="email" placeholder="Email" required>
</div>

<div class="input-box">
    <input type="text" id="phone_number" name="phone_number" placeholder="Numri i telefonit" required>
</div>

<div class="input-box">
    <input type="password" id="password" name="password" placeholder="Password" required>
</div>

<div class="input-box">
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
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