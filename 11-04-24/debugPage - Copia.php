<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>registra proprietario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input,
        textarea {
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #8f00ff; 
            color: #fff;
            cursor: pointer;
        }

        .home-button {
            background-color: #8f00ff;
            color: #fff;
            text-decoration: none;
            padding: 8px;
            border-radius: 4px;
            text-align: center;
            margin-top: 16px;
            cursor: pointer;
            width: 100%;
            display: inline-block;
        }
    </style>    
</head>
<body>
    <div class="container">
        <h2>registra proprietario</h2>
        <form action="debugPage - Copia.php" method="post">
            <label for="name">nome:</label>
            <input type="text" id="name" name="name" required>

            <label for="phone">telefono:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="note">note particolari:</label>
            <textarea id="note" name="note"></textarea>

            <input type="submit" value="Register">
        </form>

        <a href="debugPage.php" class="home-button">Torna alla Home</a>
    </div>
</body>
</html>
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "ageziamontanelli";


$connection = mysqli_connect($host, $username, $password, $database);


if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $name = mysqli_real_escape_string($connection, $_POST["name"]);
    $phone = mysqli_real_escape_string($connection, $_POST["phone"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $note = mysqli_real_escape_string($connection, $_POST["note"]);

  
    $query = "INSERT INTO PROPRIETARIO (nome, numeroTelefono, email, note) 
              VALUES ('$name', '$phone', '$email', '$note')";


    $result = mysqli_query($connection, $query);

 
    if ($result) {
      
        $lastOwnerId = mysqli_insert_id($connection);

        
        header("Location: visualizzaProp.php?owner_id=$lastOwnerId");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}


mysqli_close($connection);
?>