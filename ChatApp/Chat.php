<?php
namespace ChatApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {

  protected $clients;
  protected $database;

  public function __construct()
  {
    $this->clients = new \SplObjectStorage;
    $this->database = new Database();
  }

  public function onOpen(ConnectionInterface $conn)
  {
    // Store the new connection to send messages to later
    $this->clients->attach($conn);

    $messages = $this->database->getAllRecords( 'messages' );
    $return = "";
    foreach($messages as $message) {
        $return .= $message['message'];
    }


    $conn->send(
            json_encode([
                'type' => 'message',
                'message' => $return
            ]));


    echo "New connection! ({$conn->resourceId})\n";
  }


  public function onMessage(ConnectionInterface $from, $msg)
  {
    $numRecv = count($this->clients) - 1;
    echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
      , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

    $message = json_decode($msg);
    switch($message->event) {

      case "join":
        $from->userName = $message->username;
        $from->userColor = $message->color;
        $return = [
          "type" => "join",
          "clients" => $this->getClientNames(),
          "message" =>  "<p class='alert alert-success'><strong>" . $from->userName . "</strong> has just joined the room</p>"
        ];

        $from->send(json_encode([
          "type" => "clients",
          "clients" => $this->getClientNames(),
          "message" => ""
        ]));
        break;

      case "message":

        $return = [
          "type" => "message",
          "message" => str_replace( "<p" , "<p style='color: " . $from->userColor . "; background: #FFF;'" , $message->content )
        ];

        $this->database->addRecord( 'messages' , [ 'message' => $return['message'] , 'color' => $from->userColor ] );

        break;

    }

    $return = json_encode($return);

    foreach ($this->clients as $client) {
      if ($from !== $client) {
        // The sender is not the receiver, send to each client connected

        $client->send($return);
      }
    }
  }


  public function onClose(ConnectionInterface $conn)
  {
    // The connection is closed, remove it, as we can no longer send it messages
    $this->clients->detach($conn);

      foreach($this->clients as $client) {
          $client->send(json_encode([
              "type" => "clients",
              "clients" => $this->getClientNames(),
              "message" => "<p class='alert alert-info'><strong>" . $conn->userName . "</strong> has left the chat</p>"
          ]));
      }


    echo "Connection {$conn->resourceId} has disconnected\n";
  }


  public function onError(ConnectionInterface $conn, \Exception $e)
  {
    echo "An error has occurred: {$e->getMessage()}\n";

    $conn->close();
  }



  private function getClientNames()
  {
    $return = [];

    foreach($this->clients as $client) {
      if(isset($client->userName))
        $return[] = $client->userName;
    }

    return $return;
  }


}