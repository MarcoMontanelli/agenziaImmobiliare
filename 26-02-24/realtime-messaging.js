$(document).ready(function() {
    
    setInterval(getMessages, 2000);
});

function toggleChat() {
    $('#chat-container').toggle();
}

function getMessages() {

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
    
    
    $.ajax({
        url: 'send_message.php',
        method: 'POST',
        data: { message: message },
        success: function() {
           
            $('#message').val('');
        }
    });
}