<?php
session_start();

// Simulazione di credenziali (sostituisci con un sistema di autenticazione reale)
$valid_username = "utente";
$valid_password = "password";

// Ricezione dei dati dal modulo di login
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Verifica delle credenziali
if ($username == $valid_username && $password == $valid_password) {
    // Accesso corretto, reindirizza alla pagina di benvenuto
    $_SESSION['username'] = $username;
    header("Location: home.php");
    exit();
} else {
    // Accesso non valido, reindirizza alla pagina di login
    header("Location: login.php");
    exit();
}
?>