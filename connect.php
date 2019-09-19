<?php
$servername = "172.18.18.90";
$username = "user_ig";
$password = "password";
$dbname = "my_instagram";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>