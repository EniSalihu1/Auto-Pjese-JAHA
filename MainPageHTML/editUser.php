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
    $role = $row["role"]; // Merr rolin ekzistues

} else {
    $id = $_POST["id"];
    $emri = $_POST["emri"];
    $mbiemri = $_POST["mbiemri"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $role = $_POST["role"]; // Merr rolin nga forma

    do {
        if (empty($emri) || empty($mbiemri) || empty($email) || empty($phone_number) || empty($role)) {
            $errorMessage = "Të gjitha fushat janë të detyrueshme!";
            break;
        }

        // UPDATE që përfshin rolin
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edito Përdoruesin</title>
</head>
<body>

<div class="container">
    <h2>Edito Përdoruesin</h2>

    <?php if (!empty($errorMessage)) { echo "<p style='color:red;'>$errorMessage</p>"; } ?>
    <?php if (!empty($successMessage)) { echo "<p style='color:green;'>$successMessage</p>"; } ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="input-box">
            <input type="text" name="emri" placeholder="Emri" required value="<?php echo htmlspecialchars($emri); ?>">
        </div>

        <div class="input-box">
            <input type="text" name="mbiemri" placeholder="Mbiemri" required value="<?php echo htmlspecialchars($mbiemri); ?>">
        </div>

        <div class="input-box">
            <input type="email" name="email" placeholder="Email" required value="<?php echo htmlspecialchars($email); ?>">
        </div>

        <div class="input-box">
            <input type="text" name="phone_number" placeholder="Numri i telefonit" required value="<?php echo htmlspecialchars($phone_number); ?>">
        </div>

        <!-- Shtimi i një dropdown për rolin -->
        <div class="input-box">
            <label for="role">Roli:</label>
            <select name="role" id="role">
                <option value="admin" <?php if($role == "admin") echo "selected"; ?>>Admin</option>
                <option value="client" <?php if($role == "client") echo "selected"; ?>>Client</option>
            </select>
        </div>

        <div class="input-box">
            <button type="submit" class="btn">Ruaj Ndryshimet</button>
        </div>

        <div class="input-box">
            <a href="dashboard.php" class="btn">Anulo</a>
        </div>
    </form>

</div>

</body>
</html>
