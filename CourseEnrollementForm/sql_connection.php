<?php
$conn = mysqli_connect("localhost", "root", "", "course_enrollement");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully"; // Optional
?>
