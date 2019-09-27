<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create('id_ID');

$servername = "localhost";
$username = "mysql";
$password = "";
$dbname = "my_instagram";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// iterasi insert data
for($i=0;$i<10000; $i++){
    $date = $faker->dateTimeThisYear();
    $date = json_decode(json_encode($date),true);
    $date = $date["date"];
    
    $sql = "INSERT INTO logs (ip_address,new_data,users_id,created_at)
    VALUES ('".$faker->ipv4."', '".json_encode($faker->words(20))."', ".get_one_user($conn).", '".$date."')";
    
    if (mysqli_query($conn, $sql)) {
        echo "+";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "x";
    }
}

function get_one_user($conn){
    $sql = 'SELECT id FROM users where id < 100 order by RAND() limit 1';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['id'];
}