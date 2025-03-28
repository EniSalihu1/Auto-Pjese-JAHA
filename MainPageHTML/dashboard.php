

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    
<!-- Dashboard Container -->
<div class="dashboard-container">
        <h1>Admin Dashboard</h1>

        <!-- Shfaqja e Përdoruesve -->
        <h2>Përdoruesit</h2>
        <a href="createUser.php"> <button class="add-button">Shto Përdoruesin</button></a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Veprimet</th>
                </tr>
            </thead>

            <tbody>

            <?php
                // Lidhja me bazën e të dhënave
                $conn = new mysqli("localhost", "root", "", "autopjese_jaha");
                if ($conn->connect_error) {
                    die("Lidhja dështoi: " . $conn->connect_error);
                }

                // Shfaqja e të gjithë përdoruesve
                $sql = "SELECT * FROM user";
                $result = $conn->query($sql);

                if(!$result){

                    die("Invalid query: ". $conn ->error);
                }

                while($row = $result->fetch_assoc()){

                    echo "
                        <tr>
                        <td>$row[id]</td>
                        <td>$row[emri]</td>
                        <td>$row[mbiemri]</td>
                        <td>$row[email]</td>
                        <td>$row[phone_number]</td>
                        <td>$row[password]</td>
                        <td>$row[role]</td>
                        <td>
                            <a href='editUser.php?id={$row['id']}'>Edito</a> | 
                            <a href='deleteUser.php?id={$row['id']}' onclick='return confirm(\"A je i sigurt?\")'>Fshij</a>
                       </td>

                       
                        </tr>
                    ";
                }
                ?>
                    
            </tbody>
        </table>
     </div>

    <div class="dashboard-product">
    <h1>Produktet</h1>
    <a href="createProduct.php"><button class="add-button">Shto Produktin</button></a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imazhi</th>
                <th>Titulli</th>
                <th>Çmimi</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>

        <?php


            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "autopjese_jaha";

            // Lidhja me databazën
            $conn = new mysqli($servername, $username, $password, $database);

            // Kontrollo lidhjen
            if ($conn->connect_error) {
              die("Lidhja dështoi: " . $conn->connect_error);
            }

            // Query për të marrë të dhënat nga tabela bodykitproduktet
            $sql = "SELECT * FROM bodykitproduktet";
            $result = $conn->query($sql);

         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td><img src='{$row['image']}' width='100' height='100'></td>
                        <td>{$row['titulli']}</td>
                        <td>{$row['cmimi']}€</td>
                        <td>
                            <a href='editProduct.php?id={$row['id']}'>Edito</a> | 
                            <a href='deleteProduct.php?id={$row['id']}' onclick='return confirm(\"A je i sigurt?\")'>Fshij</a>
                        </td>
                    </tr>
                ";
            }
        } else {
            echo "<tr><td colspan='5'>Nuk ka produkte të regjistruara.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>


        

</body>
</html>