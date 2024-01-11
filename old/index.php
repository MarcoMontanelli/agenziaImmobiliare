<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messaggistica Realtime</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="realtime-messaging.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        #chat-container {
            margin-top: 20px;
        }

        #messages {
            max-height: 200px;
            overflow-y: scroll;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background-color: #fff;
        }

        input[type="text"] {
            width: 60%;
            padding: 8px;
            margin-right: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 8px;
            border: none;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <button onclick="toggleChat()">Apri Chat</button>
        <div id="chat-container" style="display: none;">
            <div id="messages"></div>
            <input type="text" id="message" placeholder="Inserisci il tuo messaggio">
            <button onclick="sendMessage()">Invia</button>
        </div>
    </div>
</body>
</html>