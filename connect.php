<?php
  // connect to db
  $conn = new mysqli('localhost', 'root', '', 'rqs');
  if ($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
  }
?>