<?php
session_start();

require_once 'db_produktet.php';
 
    
// Inicializimi i lidhjes me bazën e të dhënave dhe objekti UserProduktet
$database = new db_produktet();
$pdo = $database->getConnection();
$userProduktet = new UserProduktet($pdo);

// Trajtimi i formës për shtimin e produktit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"]) && isset($_POST["titulli"]) && isset($_POST["cmimi"])) {
    try {
        // Ngarko imazhin në server
        $targetDir = "../Images/";
        $imageName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $imageName;

        // Kontrollo nëse imazhi është ngarkuar me sukses
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Shto produktin në bazën e të dhënave
            if ($userProduktet->create($imageName, $_POST["titulli"], $_POST["cmimi"])) {
                header("Location: Produkt.php?success=1");
                exit();
            } else {
                throw new Exception("Gabim gjatë shtimit të produktit në bazën e të dhënave.");
            }
        } else {
            throw new Exception("Gabim gjatë ngarkimit të imazhit.");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Kontrollo nëse përdoruesi është i kyçur dhe roli i tij
$isLoggedIn = isset($_SESSION['user_id']);
$role = $_SESSION['role'] ?? 'client';

// Merr të gjitha produktet nga baza e të dhënave
$produktet = $userProduktet->readAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktet</title>
    <link rel="stylesheet" href="../ProduktetCss/BodyKit.css">
</head>
<body>
    <!-- Navigimi -->
    <header class="nav">
        <a href="./Main.php">
            <img src="../Images/Logo.jpg" alt="Logo">
        </a>
        <ul>
            <li><a href="Main.php">Home</a></li>
            <li><a href="News.php">News</a></li>
            <li><a href="Produkt.php">Products</a></li>
            <li><a href="AboutUs.php">About Us</a></li>
            <li><a href="Contact.php">Contact Us</a></li>
            <li>
                <?php if ($isLoggedIn): ?>
                    <button><a href="logout.php" id="LogOutButton">Log Out</a></button>
                <?php else: ?>
                    <button><a href="login.php" id="LogInButton">Log In</a></button>
                <?php endif; ?>
            </li>
        </ul>
    </header>

    <!-- Përmbajtja kryesore -->
    <main class="products-section">
        <div class="Hyrja">
            <h1>Produktet e pranishme:</h1>
        </div>

        <!-- Shfaqja e produkteve -->
        <div class="product-grid">
            <?php foreach ($produktet as $produkt): ?>
                <div class="product-item">
                    <img src="../Images/<?php echo htmlspecialchars($produkt['image']); ?>" alt="<?php echo htmlspecialchars($produkt['titulli']); ?>">
                    <h2><?php echo htmlspecialchars($produkt['titulli']); ?></h2>
                    <p><?php echo htmlspecialchars($produkt['cmimi']); ?>€</p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Butoni për shtimin e produktit (vetëm për admin) -->
        <?php if ($role === 'admin'): ?>
            <div class="add-button-container">
                <button class="add-news-btn" onclick="toggleForm()"> +Shto Produkt</button>

                <!-- Forma për shtimin e produktit -->
                <form id="news-form" action="Produkt.php" method="POST" enctype="multipart/form-data" style="display: none;">
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>

                    <label for="titulli">Titulli:</label>
                    <input type="text" id="titulli" name="titulli" required>

                    <label for="cmimi">Cmimi:</label>
                    <input type="text" id="cmimi" name="cmimi" required>

                    <button type="submit">Submit</button>
                </form>
            </div>
        <?php endif; ?>
    </main>
 
 <script>
        function toggleForm() {
            const form = document.getElementById('news-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>

    <!-- Footer -->
    <div class="footer">
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
                    <a href="https://www.facebook.com/profile.html?id=100039106436166"><img src="../Images/Facebook.webp" alt="Facebook"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 AutoPjesa. Të gjitha të drejtat e rezervuara.</p>
        </div>
    </div>

    <!-- JavaScript për të toggle formën -->
   
</body>
</html>