<?php

$servername = "localhost";
$username = "root";
$password ="";
$database = "autopjese_jaha";

 //Lidhja 

 $conn = new mysqli($servername, $username, $password, $database);

$emri = "";
$mbiemri = "";
$email ="";
$phone_number="";
$password = "";
$confirm_password ="";

$errorMessage ="";
$successMessage ="";

if( $_SERVER ['REQUEST_METHOD'] == 'POST'){

    $emri = $_POST["emri"];
    $mbiemri = $_POST["mbiemri"];
    $email =$_POST["email"];
    $phone_number=$_POST["phone_number"];
    $password = $_POST["password"];
    $confirm_password =$_POST["confirm_password"];

    do{

        if(empty($emri) || empty($mbiemri) ||empty($email) ||empty($phone_number) ||empty($password) || empty($confirm_password)){
            $errorMessage = "All the fields are required";
            break;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // add new client in database

        $sql = "INSERT INTO user (emri, mbiemri, email, phone_number, password)" . 
                "VALUES ('$emri', '$mbiemri','$email','$phone_number','$hashedPassword')";
        $result = $conn -> query($sql);

        if(!$result){

            $errorMessage = "Invalid query: ". $conn -> error;
            break; 
        }

        $emri = "";
        $mbiemri = "";
        $email ="";
        $phone_number="";
        $password = "";
        $confirm_password ="";

        $successMessage ="Client added correctly";

        header("location: dashboard.php"); 

    }while(false);

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreateUser</title>
    <link rel="stylesheet" href="../ProduktetCss/CreateUser.css"> 
</head>
<body>

<div class="container">
    <h2>New Client</h2>

    <form method="POST">

    <?php
        if(!empty($errorMessage)){

            echo "Nese nuk eshte e shprazet";
        }
    ?>
    <div class="input-box">
            <input type="text" name="emri" placeholder="Emri"  required value=" <?php echo $emri; ?>"></div>

            <div class="input-box">
            <input type="text" name="mbiemri" placeholder="Mbiemri" required value="<?php echo $mbiemri; ?>"></div>

            <div class="input-box">
            <input type="email" id="email" name="email" placeholder="Email" required value="<?php echo $email; ?>"> </div>

            <div class="input-box">
            <input type="text" id="phone_number" name="phone_number" placeholder="Numri i telefonit" required value="<?php echo $phone_number; ?>"></div>

            <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Password" required value="<?php echo $password; ?>"></div>

            <div class="input-box">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required value="<?php echo $confirm_password; ?>"></div>
    
            <?php

                if(!empty($successMessage)){

                    echo "Sukses!";
                }
            ?>
    
            <div class="input-box">
             <button type="submit" class="btn ">Submit</button> </div>

             <div class="input-box">
             <button type="submit" class="btn " onclick="dashboard.php">Cancel</button> </div>

    </form>

</div>
    
</body>
</html>