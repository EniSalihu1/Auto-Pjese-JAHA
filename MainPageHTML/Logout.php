<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <script>
        // Fshin historinë e shfletuesit dhe ridrejton përdoruesin
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
        window.location.href = "LogIn.php";
    </script>
</head>
<body>
</body>
</html>