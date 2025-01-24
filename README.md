# RabbitMQ Publish/Subscribe Queue

PHP simplest study on RabbitMQ routing queues, with a basic UI for emitting logs. 

## How to run

### Run RabbitMQ
docker run -it --rm --name rabbitmq -p 5672:5672 -p 15672:15672 rabbitmq:4.0-management

### To receive all the logs:
php receive_logs_topic.php "#"

### To receive all logs from the kernel:
php receive_logs_topic.php "kernel.*"

### To receive only about critical logs:
php receive_logs_topic.php "*.critical"

### To create multiple bindings:
php receive_logs_topic.php "kernel.*" "*.critical"

### To emit logs
Navigate to index.html and emit a log.
