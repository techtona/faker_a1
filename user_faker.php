<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create('id_ID');

$servername = "172.18.18.90";
$username = "user_ig";
$password = "password";
$dbname = "my_instagram";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// iterasi insert data
for($i=0;$i<100000; $i++){
    $sql = "INSERT INTO users (username, password, name)
    VALUES ('".$faker->userName."', '".$faker->password."', '".$faker->name."')";
    
    if (mysqli_query($conn, $sql)) {
        echo "+";
    } else {
        // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "x";
    }
}