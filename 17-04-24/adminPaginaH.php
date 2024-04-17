
<?php
/*
// Avvia la sessione PHP se non è già stata avviata
if (!session_id()) session_start();

// Controlla se esiste un tipo di utente nella sessione o nei cookie e se questo tipo è 'cliente'
$userType = $_SESSION['user_type'] ?? $_COOKIE['user_type'] ?? '';
$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? '';

// Se l'utente non è autenticato come 'cliente', reindirizzalo alla pagina di login
if ($userType !== 'admin') {
    // Mostra un messaggio di errore per 3 secondi prima di reindirizzare
   echo $userType;
   echo $userId;
    echo "<p>Accesso non autorizzato. Verrai reindirizzato alla pagina di login.</p>";
    header("Refresh: 3; url=loginup.php"); // Assicurati che login.php sia il percorso corretto per la tua pagina di login
    exit(); // Termina l'esecuzione dello script
}


// Qui inizia il resto del codice della pagina, che verrà eseguito solo se l'utente è un cliente
*/
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>azioni admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-black">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 md:p-8 lg:p-12 space-y-4 md:space-y-6 max-w-md mx-auto">
        <a href="#" class="flex items-center justify-center mb-6">
            <img class="w-8 h-8 mr-2" src="agenLogo.svg" alt="montanelli Logo">
            <span class="text-2xl font-semibold text-gray-900 dark:text-white">Agenzia Montanelli</span>
        </a>
        <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
            Azioni Admin
        </h1>

        <a href="register.php"
            class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Registra
            Agenzia</a>

        <a href="registerA.php"
            class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Registra
            Admin</a>

        <a href="removeAgenzia.php"
            class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Rimuovi
            Agenzia</a>
        <a href="removeAdmin.php"
            class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Rimuovi
            Admin</a>

        <a href="removeCliente.php"
            class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Rimuovi
            Clienti</a>

    </div>
</body>

</html>