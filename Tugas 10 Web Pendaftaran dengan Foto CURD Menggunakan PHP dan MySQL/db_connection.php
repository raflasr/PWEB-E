<?php
// db_connection.php
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_registration";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//untuk cek
//http://localhost/Student_Registration/db_connection.php
?>
