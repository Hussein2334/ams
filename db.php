<?php
$conn = mysqli_connect("localhost", "root", "", "ams");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
