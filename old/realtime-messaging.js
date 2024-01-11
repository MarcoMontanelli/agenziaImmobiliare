$(document).ready(function() {
    // Imposta l'intervallo per aggiornare i messaggi ogni 2 secondi
    setInterval(getMessages, 2000);
});

function toggleChat() {
    $('#chat-container').toggle();
}

function getMessages() {
    // Effettua una chiamata AJAX per ottenere i messaggi più recenti dal database
    $.ajax({
        url: 'get_messages.php',
        method: 'GET',
        success: function(response) {
            $('#messages').html(response);
        }
    });
}

function sendMessage() {
    var message = $('#message').val();
    
    // Effettua una chiamata AJAX per inviare il messaggio
    $.ajax({
        url: 'send_message.php',
        method: 'POST',
        data: { message: message },
        success: function() {
            // Pulisce il campo di input dopo l'invio del messaggio
            $('#message').val('');
        }
    });
}