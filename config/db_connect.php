<?php
    // Use MySQLi for sql database
    // Connect to the database
    $conn = mysqli_connect('localhost', 'xxx', 'xxxx', 'morse_pizza');

    // Check connection
    if(!$conn){
        echo 'Connection error: '. mysqli_connect_error();
    }
?>