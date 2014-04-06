<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>
  <div class="container">
    <div class="row">

      <div class="col-sm-8">

        <h2>Chat Message Board</h2>
        <div id="message-board" style="min-height: 100px; border: 1px solid #999; border-radius: 10px;"></div>

      </div>

      <div class="col-sm-4">
        <br/>
        <button class="btn btn-primary" id="logout-button"><i class="glyphicon glyphicon-log-out"></i> Logout</button><br/>
        <p>Welcome to chat, <strong id="username-greeting"></strong></p>
        <br/>

        <div class="form-horizontal well">
            <a class="btn btn-danger btn-block" href="clear.php"><i class="glyphicon glyphicon-trash"></i> Clear Chat</a>
            <br/><br/>
          <p class="alert alert-info"><strong>Send a Message:</strong></p>
          <div class="form-group">
            <label for="message">Message:</label><br/>
            <textarea name="message" id="message" cols="30" rows="4" style="resize: none; width: 100%; padding: 5px;" maxlength="150"></textarea>
          </div>
          <div class="form-group">
            <button id="send-message-btn" class="btn btn-success btn-block"><i class="glyphicon glyphicon-chevron-right"></i> SEND</button>
          </div>
        </div>


        <div class="well">



          <p class="alert alert-info">In the Chat Room</p>
          <ul id="chat-room-list">
          </ul>
        </div>
      </div>

    </div>
    <div class="row">




      <div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body">

                <h1 class="text-center">Welcome to <strong>Chat App</strong></h1>
                <p class="text-center">a product of...</p>

                <p class="text-center">
                  <strong style="font-size: 20px;">AL</strong><br/>
                  <img src="img/intro-brown.png" alt="" style="max-width: 75%;"/>
                </p>
                <hr/>

                <form class="form-horizontal" id="sign-in-form">
                  <fieldset>

                    <p>Please choose your chat name...</p>
                    <!-- Text input-->
                    <div class="control-group">
                      <label class="control-label" for="userid">Chat Name:</label>
                      <div class="controls">
                        <input id="userid" maxlength="15" name="userid" class="form-control" type="text" placeholder="JoeSixpack" class="input-large" required="">
                      </div>
                    </div>
                    <br/>
                    <p>Please choose a chat color:</p>
                    <div class="control-group">
                      <label class="control-label" for="chat-color">Chat Color:</label>
                      <div class="controls">
                        <input type="color" name="chat-color" id="chat-color"/>
                      </div>
                    </div>

                    <!-- Button -->
                    <div class="control-group">
                      <label class="control-label" for="confirmsignup"></label>
                      <div class="controls">
                        <button id="confirmsignin" name="confirmsignup" class="btn btn-success btn-block">Sign In</button>
                      </div>
                    </div>
                  </fieldset>
                </form>

            </div>
          </div>
        </div>



    </div>
  </div>



  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/chat.js"></script>
</body>
</html>