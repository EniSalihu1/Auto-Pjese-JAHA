<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Mirë se erdhët, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Roli juaj: <?php echo htmlspecialchars($role); ?></p>

    <?php if ($role === 'admin'): ?>
        <h2>Menaxhimi i faqes</h2>
        <a href="manage_users.php">Menaxho përdoruesit</a>
    <?php elseif ($role === 'editor'): ?>
        <h2>Menaxho përmbajtjen</h2>
        <p>Ju mund të redaktoni artikujt.</p>
    <?php else: ?>
        <h2>Shikoni përmbajtjen</h2>
        <p>Ju keni akses vetëm për lexim.</p>
    <?php endif; ?>

    <a href="logout.php">Dil</a>
</body>
</html>
