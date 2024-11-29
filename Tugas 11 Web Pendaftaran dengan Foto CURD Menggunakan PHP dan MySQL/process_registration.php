<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nrp = $_POST['nrp'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $birthplace = $_POST['birthplace'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $school_origin = $_POST['school_origin'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO students (nrp, name, address, birthplace, birthdate, gender, religion, school_origin, email, phone)
            VALUES ('$nrp', '$name', '$address', '$birthplace', '$birthdate', '$gender', '$religion', '$school_origin', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil!";
        header("Location: students.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>