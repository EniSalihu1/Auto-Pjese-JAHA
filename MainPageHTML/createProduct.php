<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shto Produkt</title>
    <link rel="stylesheet" href="../ProduktetCss/createProduct.css"> 
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
        session_start();
        $isLoggedIn = isset($_SESSION['isLoggedIn']) ? $_SESSION['isLoggedIn'] : false;
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
        
        if ($isLoggedIn && $role === 'admin'): ?>            
            <li><a href="dashboard.php">Dashboard</a></li>          
        <?php endif; ?>
        <li>
                <?php if ($isLoggedIn): ?> 
                    <a href="Login.php" style="font-family: Courier, monospace; background-color: #054442; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;" class="auth-button logout">
                        Log In
                    </a>
                <?php else: ?>
                    <a href="Logout.php" style="font-family: Courier, monospace; background-color: #f44336; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;" class="auth-button login">
                        Log Out
                    </a>
                <?php endif; ?>
            </li>
</ul>
</header>
    
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "autopjese_jaha";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Lidhja dështoi: " . $conn->connect_error);
}

$titulli = "";
$cmimi = "";
$image = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulli = $_POST["titulli"];
    $cmimi = $_POST["cmimi"];

    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $errorMessage = "Skedari nuk është një imazh!";
        } elseif ($_FILES["image"]["size"] > 5000000) { 
            $errorMessage = "Imazhi është shumë i madh!";
        } elseif (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            $errorMessage = "Lejohen vetëm formatet JPG, JPEG, PNG & GIF!";
        } else {
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            } else {
                $errorMessage = "Ndodhi një gabim gjatë ngarkimit të imazhit!";
            }
        }
    } else {
        $errorMessage = "Ju lutem ngarkoni një imazh!";
    }

    if (empty($errorMessage)) {
        $sql = "INSERT INTO bodykitproduktet (image, titulli, cmimi) VALUES ('$image', '$titulli', '$cmimi')";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Produkti u shtua me sukses!";
            header("Location: dashboard.php"); 
            exit;
        } else {
            $errorMessage = "Gabim në query: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shto Produkt</title>
    <link rel="stylesheet" href="../ProduktetCss/createProduct.css"> 
</head>
<body>

<div class="container">
    <h2>Shto Produkt</h2>

    <?php if (!empty($errorMessage)) { echo "<p style='color:red;'>$errorMessage</p>"; } ?>
    <?php if (!empty($successMessage)) { echo "<p style='color:green;'>$successMessage</p>"; } ?>

    <form method="POST" enctype="multipart/form-data">
        <label for="image">Imazhi:</label>
        <input type="file" id="image" name="image" required>

        <label for="titulli">Titulli:</label>
        <input type="text" id="titulli" name="titulli" required value="<?php echo htmlspecialchars($titulli); ?>">

        <label for="cmimi">Çmimi:</label>
        <input type="text" id="cmimi" name="cmimi" required value="<?php echo htmlspecialchars($cmimi); ?>">

        <button type="submit">Shto Produktin</button>
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
