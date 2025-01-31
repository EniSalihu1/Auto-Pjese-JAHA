<?php

include_once 'db_autopjese.php';
include_once 'User.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $db = new db_autopjese();
        $connection = $db->getConnection();
        $user = new User (db : $connection);

        $emri = $_POST['emri'];
        $mbiemri = $_POST['mbiemri'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if($user->register(emri : $emri, mbiemri : $mbiemri, email : $email, phone_number: $phone_number, password:$password, confirm_password:$confirm_password)){
            header(header:"Location: LogIn.php");
            exit;
        }else{
            echo "Error registering user!";
        }
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
    
    <div class="wrapper"> 
        <form id="registerForm" action="Register.php" method="POST">
            <div id="Hyrje">
                <img src="../Images/Logo.jpg" alt="">
                <h1>Register Here!</h1>
            </div>

            <div class="input-box">
            <input type="text" name="emri" placeholder="Emri"  required></div>

            <div class="input-box">
            <input type="text" name="mbiemri" placeholder="Mbiemri" required></div>

            <div class="input-box">
            <input type="email" id="email" name="email" placeholder="Email" required> </div>

            <div class="input-box">
            <input type="text" id="phone_number" name="phone_number" placeholder="Numri i telefonit" required></div>

            <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Password" required></div>

            <div class="input-box">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required></div>
    
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