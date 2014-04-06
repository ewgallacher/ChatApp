var messageBoard, chatRoomList, username , sendMessageButton, chatMessage, conn;

$(document).ready(function()
{
    messageBoard = $('#message-board');
    chatRoomList = $('#chat-room-list');
    sendMessageButton = $('#send-message-btn');
    chatMessage = $('#message')
});


conn = new WebSocket('ws://192.168.43.106:8888');

conn.onopen = function(e)
{
    $('#myModal').modal({
        'backdrop': 'static'
    });
};

conn.onmessage = function(e)
{
    var message = JSON.parse(e.data);

    console.log( message );

    switch(message.type) {

        case "join":
            clearChatRoomList();
            for(var i = 0 ; i < message.clients.length ; i++)
                addToChatRoomList(message.clients[i]);

            break;

        case "message":

            break;

        case "clients":
            clearChatRoomList();
            for(var i = 0 ; i < message.clients.length ; i++)
                addToChatRoomList(message.clients[i]);
            break;
    }

    messageBoard.prepend(message.message);
};






/* Sign In */
$('#confirmsignin').click(function(e)
{
    e.preventDefault();
    username = $('#userid').val();

    if(username === '')
        return;

    $('#username-greeting').html(username);
    $('#username-greeting').css('color' , $('#chat-color').val());
    addToChatRoomList( username );
    $('#myModal').modal('hide');

    var msg = {
       event: "join",
       username: username,
       color: $('#chat-color').val()
    };
    conn.send(JSON.stringify(msg));


    sendMessageButton.click(function(e)
    {
        e.preventDefault();
        messageBoard.prepend( '<div class="alert alert-danger"><strong>YOU</strong> said: <em>' + chatMessage.val() + '</em></div>' );

        var msg = {
            event: 'message',
            content: '<p class="alert alert-info"><strong>' + username + '</strong> said: <em>' + chatMessage.val() + '</em></p>'
        };
        conn.send(JSON.stringify(msg));
        chatMessage.val("");
    });


    $('#logout-button').click(function(e)
    {
        conn.close();
        location.reload();
    });
});



function addToChatRoomList( name )
{
    chatRoomList.append('<li><strong>' + name + '</strong></li>');
}

function clearChatRoomList()
{
    chatRoomList.html("");
}

