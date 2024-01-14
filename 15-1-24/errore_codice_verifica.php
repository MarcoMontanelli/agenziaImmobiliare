<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Error Page</title>
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
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        img {
            width: 100%;
            max-width: 300px;
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            background-color: #8f00ff; 
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            background-color: #6a0099; 
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="no-results.png" alt="Error Image">
        <h2>CODICE SCADUTO</h2>
        <p>la tua richiesta è stata anullata, non hai verificato l'account in tempo, riprova più tardi</p>
        <button onclick="location.href='debugPage.php'">torna alla home</button>
    </div>
</body>
</html>