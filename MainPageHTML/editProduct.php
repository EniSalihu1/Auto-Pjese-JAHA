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

$titulli = "";
$cmimi = "";
$image = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: dashboard.php");
        exit;
    }

    $id = intval($_GET["id"]);
    $sql = "SELECT * FROM bodykitproduktet WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: dashboard.php");
        exit;
    }

    $image = $row["image"];
    $titulli = $row["titulli"];
    $cmimi = $row["cmimi"];
} else {
    $id = $_POST["id"];
    $titulli = $_POST["titulli"];
    $cmimi = $_POST["cmimi"];

    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $errorMessage = "Skedari nuk është imazh!";
        } elseif ($_FILES["image"]["size"] > 5000000) {
            $errorMessage = "Imazhi është shumë i madh!";
        } elseif (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            $errorMessage = "Formatet e lejuara janë JPG, JPEG, PNG & GIF!";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            } else {
                $errorMessage = "Gabim gjatë ngarkimit të imazhit!";
            }
        }
    } else {

        $image = $_POST["existing_image"];
    }

    if (empty($titulli) || empty($cmimi)) {
        $errorMessage = "Të gjitha fushat janë të detyrueshme!";
    } else {
        $sql = "UPDATE bodykitproduktet 
                SET image = '$image', titulli = '$titulli', cmimi = '$cmimi' 
                WHERE id = $id";
        
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Produkti u përditësua me sukses!";
            header("location: dashboard.php");
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
    <title>Edito Produktin</title>
    <link rel="stylesheet" href="../ProduktetCss/editProduct.css">
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
</head>
<body>

<div class="container">
    <h2>Edito Produktin</h2>

    <?php if (!empty($errorMessage)) { echo "<p style='color:red;'>$errorMessage</p>"; } ?>
    <?php if (!empty($successMessage)) { echo "<p style='color:green;'>$successMessage</p>"; } ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="existing_image" value="<?php echo $image; ?>">

        <label for="image">Imazhi (lëre bosh nëse nuk doni ta ndryshoni):</label>
        <input type="file" id="image" name="image">
        <br>
        <img src="<?php echo $image; ?>" alt="Imazhi aktual" width="100">

        <label for="titulli">Titulli:</label>
        <input type="text" id="titulli" name="titulli" required value="<?php echo $titulli; ?>">

        <label for="cmimi">Çmimi:</label>
        <input type="text" id="cmimi" name="cmimi" required value="<?php echo $cmimi; ?>">

        <button type="submit">Ruaj Ndryshimet</button>
        <a href="dashboard.php">Anulo</a>
    </form>
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
</div>

</body>
</html>
