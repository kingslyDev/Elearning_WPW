<?php
$servername = "urServerNameDB"; 
$username = "urUsernameDB"; 
$password = ""; 
$dbname = "urnameDB"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
