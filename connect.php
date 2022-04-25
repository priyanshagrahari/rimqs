<?php 
  $conn = new mysqli('localhost', 'root', '', 'rqs');
  if ($conn->connect_errno) {
    die('Connection Failed : '.$conn->connect_error);
  }
?>