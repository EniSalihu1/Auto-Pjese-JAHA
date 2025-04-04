<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edito Përdoruesin</title>
    <link rel="stylesheet" href="../ProduktetCss/editUser.css">
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

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "autopjese_jaha";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Lidhja dështoi: " . $conn->connect_error);
}

$id = "";
$emri = "";
$mbiemri = "";
$email = "";
$phone_number = "";
$role = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: dashboard.php");
        exit;
    }

    $id = intval($_GET["id"]);
    $sql = "SELECT * FROM user WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: dashboard.php");
        exit;
    }

    $emri = $row["emri"];
    $mbiemri = $row["mbiemri"];
    $email = $row["email"];
    $phone_number = $row["phone_number"];
    $role = $row["role"];
} else {
    $id = $_POST["id"];
    $emri = $_POST["emri"];
    $mbiemri = $_POST["mbiemri"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $role = $_POST["role"];

    do {
        if (empty($emri) || empty($mbiemri) || empty($email) || empty($phone_number) || empty($role)) {
            $errorMessage = "Të gjitha fushat janë të detyrueshme!";
            break;
        }

        $sql = "UPDATE user 
                SET emri = '$emri', mbiemri = '$mbiemri', email = '$email', phone_number = '$phone_number', role = '$role' 
                WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Përdoruesi u përditësua me sukses!";
            header("location: dashboard.php");
            exit;
        } else {
            $errorMessage = "Gabim në query: " . $conn->error;
        }
    } while (false);
}
?>

<div class="container">
    <h2>Edito Përdoruesin</h2>

    <?php if (!empty($errorMessage)) { echo "<p style='color:red;'>$errorMessage</p>"; } ?>
    <?php if (!empty($successMessage)) { echo "<p style='color:green;'>$successMessage</p>"; } ?>

   
    <form method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="input-box">
        <input type="text" name="emri" placeholder="Emri" required
               value="<?php echo htmlspecialchars($emri); ?>"
               style="width: 775px; padding: 10px; border-radius: 5px;">
    </div>

    <div class="input-box">
        <input type="text" name="mbiemri" placeholder="Mbiemri" required
               value="<?php echo htmlspecialchars($mbiemri); ?>"
               style="width: 775px; padding: 10px; border-radius: 5px;">
    </div>

    <div class="input-box">
        <input type="email" name="email" placeholder="Email" required
               value="<?php echo htmlspecialchars($email); ?>"
               style="width: 775px; padding: 10px; border-radius: 5px;">
    </div>

    <div class="input-box">
        <input type="text" name="phone_number" placeholder="Numri i telefonit" required
               value="<?php echo htmlspecialchars($phone_number); ?>"
               style="width: 775px; padding: 10px; border-radius: 5px;">
    </div>

    <div class="input-box">
        <label for="role">Roli:</label><br>
        <select name="role" id="role"
                style="width: 775px; padding: 10px; border-radius: 5px;">
            <option value="admin" <?php if ($role == "admin") echo "selected"; ?>>Admin</option>
            <option value="client" <?php if ($role == "client") echo "selected"; ?>>Client</option>
        </select>
    </div>

    <div class="input-box" style="display: flex; gap: 10px; justify-content: center;">
        <button type="submit"
            style="width: 180px; background-color: #054442; color: white; border: none; font-size: 16px; font-weight: bold; cursor: pointer; padding: 12px 24px; border-radius: 5px; text-align: center;">
            Ruaj Ndryshimet
        </button>

        <a href="dashboard.php"
           style="width: 180px; background-color: #054442; color: white; display: inline-block; text-decoration: none; font-size: 16px; font-weight: bold; padding: 12px 24px; border-radius: 5px; text-align: center;">
            Anulo
        </a>
    </div>
</form>
</div>

<!-- Footeri -->
<footer class="footer">
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
            <h4>Na Ndiqni në faqen tonë në:</h4>
            <div class="social-icons">
                <a href="https://www.facebook.com/profile.html?id=100039106436166">
                    <img src="../Images/Facebook.webp" alt="Facebook">
                </a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 AutoPjesa. Të gjitha të drejtat e rezervuara.</p>
    </div>
</footer>

</body>
</html>
