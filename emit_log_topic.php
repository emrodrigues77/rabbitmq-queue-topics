<?php

    require_once __DIR__ . '/vendor/autoload.php';
    use PhpAmqpLib\Connection\AMQPStreamConnection;
    use PhpAmqpLib\Message\AMQPMessage;

    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $channel    = $connection->channel();
    $message    = explode(' ', $_POST['message']);
    $topic      = $_POST['topic'];
    $severity   = $_POST['severity'];

    $channel->exchange_declare('topic_logs', 'topic', false, false, false);

    $routing_key = "$topic.$severity";

    $data = implode(' ', array_slice($message, 0));

    if (empty($data)) {
        $data = "Hello World!";
    }

    $msg = new AMQPMessage($data);

    $channel->basic_publish($msg, 'topic_logs', $routing_key);

    echo ' [x] Sent ', $routing_key, ':', $data, "\n";

    $channel->close();
    $connection->close();
?>
<br />
<a href="index.html">Back</a>