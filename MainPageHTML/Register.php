<?php

include_once 'db_autopjese.php';
include_once 'User.php';

    if($_SERVER['REQUEST_METHOD']== 'POST'){

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

/* kodi i jem
include 'db_autopjese.php'; // Lidhja me databazën

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
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

    $name = $_POST['name'];   
    $surname = $_POST['surname'];  

    // Validimi i email-it
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
     // Kontrollo nëse emaili është regjistruar më parë
     $emailCheck = $conn->prepare("SELECT id FROM users WHERE email = ?");
     $emailCheck->bind_param("s", $email);
     $emailCheck->execute();
     $emailCheck->store_result();
 
     if ($emailCheck->num_rows > 0) {
         echo "Email is already registered.";
         exit;  // Nëse emaili ekziston, ndalojmë regjistrimin
     }
     $emailCheck->close();

    // Kontrollo nëse fjalëkalimet përputhen
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Hashimi i fjalëkalimit
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Përgatitja e query-t të sigurtë për insert
    $stmt = $conn->prepare("INSERT INTO users (name, surname, email, phone_number, password, role) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('MySQL prepare failed: ' . $conn->error);
    }
    $stmt->bind_param("sssss", $name, $surname, $email, $hashedPassword, $role);

    // Ekzekuto pyetjen dhe verifiko nëse u regjistrua përdoruesi
    if ($stmt->execute()) {
        echo "User registered successfully.";
        header("Location: Login.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}*/
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
        <form id="registerForm" action="Register.php" method="POST">
            <div id="Hyrje">
                <img src="../Images/Logo.jpg" alt="">
                <h1>Register Here!</h1>
            </div>

            <div class="input-box1">
        <input type="text" name="name" placeholder="Emri"  required>
    </div>

    <div class="input-box1">
        <input type="text" name="surname" placeholder="Mbiemri" required>
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
    <button type="submit" class="btn ">Register</button>
        
</form>

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