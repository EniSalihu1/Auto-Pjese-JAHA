<?php

if(isset($_GET["id"])){

    $id =intval($_GET["id"]);

    $servername = "localhost";
    $username = "root";
    $password ="";
    $database = "autopjese_jaha";

    $conn = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM user WHERE id = $id";
    $conn->query($sql);

}

header("location: dashboard.php");
exit;


?>
