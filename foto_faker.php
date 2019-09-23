<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create('id_ID');

$servername = "172.18.43.73";
$username = "user_ig";
$password = "password";
$dbname = "my_instagram";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// select data
$sql = "SELECT id FROM users limit 100";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        // iterasi insert data
            for($i=0;$i<100; $i++){
                $sql = "INSERT INTO foto (caption, user_id, date)
                VALUES ('".$faker->sentence(30)."', '".$row['id']."', '".$faker->date('Y-m-d')."')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "+";
                } else {
                    // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    echo "x";
                }
            }
    }
} else {
    echo "0 results";
}