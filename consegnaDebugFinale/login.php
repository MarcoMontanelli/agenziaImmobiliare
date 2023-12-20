<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.container {
    max-width: 600px;
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
select {
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 10px;
    background-color: #8f00ff; 
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

button:hover {
    background-color: #6a0099;
}
    </style>
</head>
<body>
    <div class="container">
        <form action="login.php" method="post">
            <h2>Login</h2>
            <label for="email">Email:</label>
            <input type="text" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="user_type">User Type:</label>
            <select name="user_type" required>
                <option value="agenzia">Agenzia</option>
                <option value="cliente">Cliente</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
<?php
// Include database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Verifica se sono stati inviati dati dal modulo di registrazione
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    
    // Validate user inputs here
    
    // Check user credentials in the database
    if ($user_type == 'agenzia') {
        // Perform agenzia login check
        $query = "SELECT * FROM AGENZIA_IMMOBILIARE WHERE email='$email'";
    } elseif ($user_type == 'cliente') {
        // Perform cliente login check
        $query = "SELECT * FROM CLIENTE WHERE email='$email'";
    } elseif ($user_type == 'admin') {
        // Perform admin login check
        $query = "SELECT * FROM ADMIN WHERE email='$email'";
    } else {
        // Invalid user type
        echo "Invalid user type";
        exit();
    }
    
    // Execute the query and check if the user exists
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    if (mysqli_num_rows($result) > 0) {
        // User found, verify the password
        $userDetails = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $userDetails['pass'])) {
            // Password is correct, show a welcome message
            echo "Benvenuto, " . $userDetails['nome'];
        } else {
            // Invalid password, show an error message
            echo "Credenziali non valide";
        }
    } else {
        // User not found, show an error message
        echo "Credenziali non valide";
    }
    
    // Close the database connection
    mysqli_close($conn);
}



?>