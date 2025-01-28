<?php

session_start ();


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
        <form action="">
            <div id="Hyrje">

                <img src="../Images/Logo.jpg" alt="">
                <h1>Log In</h1>

            </div>
            
            <div class="input-box">
                <input type="text" placeholder="Username"
                required>
            </div>
            
            <div class="input-box">
                <input type="password" placeholder="Password"
                required>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me
                </label>
                <a href="./ForgotPassword.html">Forgot password</a>
            </div>
            <button type="submit" class="btn"><a href="./Main.html">Login </a></button>

            <div class="register-link">
                <p>Don't have an account? 
                    <a href="../MainPageHTML/Register.html"> Register</a></p>
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