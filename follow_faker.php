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

// iterasi insert data
for($i=0;$i<100000; $i++){
    //get user yg mau follow
    $USER = get_one_user($conn);
    // get user yang mau difollow
    $USER_FOLLOW = get_one_user($conn);
    $sql = "SELECT count(*) as jumlah FROM follow WHERE user_id=".$USER." AND user_follow_id = ".$USER_FOLLOW;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // Jika tidak ada status following or tidak memfollow diri sendiri maka
    if($row['jumlah'] < 1 || $USER != $USER_FOLLOW){
        $sql = "INSERT INTO follow (user_id, user_follow_id, status)
        VALUES ('".$USER."', '".$USER_FOLLOW."', '".rand(0,1)."')";
        
        if (mysqli_query($conn, $sql)) {
            echo "+";
        } else {
            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "x";
        }
    }
}

// select data users
function get_one_user($conn){
    $sql = 'SELECT id FROM users order by RAND() limit 1';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['id'];
}