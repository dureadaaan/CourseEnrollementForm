<?php
session_start();
include('header.php');

$host = "localhost";
$user = "root";
$pass = "";
$db = "course_enrollement";

// Connect to database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$department = $_POST['department'];
$semester = $_POST['semester'];
$dob = $_POST['dob'];
$comments = $_POST['comments'];
$courses = isset($_POST['courses']) ? implode(", ", $_POST['courses']) : "";

// Insert into DB
$stmt = $conn->prepare("INSERT INTO enrollment_data 
    (name, email, password, gender, department, semester, courses, dob, comments) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $name, $email, $password, $gender, $department, $semester, $courses, $dob, $comments);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enrollment Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

<?php
if ($stmt->execute()) {
    echo '
    <div class="card shadow p-4 mb-5 bg-white rounded text-center">
        <h4 class="card-title text-success">Enrollment Successful!</h4>';

    if (!empty($courses)) {
        $courseList = explode(", ", $courses);
        echo '
        <h5 class="mt-4">Enrolled Courses:</h5>
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Course Name</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($courseList as $index => $course) {
            echo "<tr><td>" . ($index + 1) . "</td><td>" . htmlspecialchars($course) . "</td></tr>";
        }
        echo '</tbody></table>';
    }

    echo '
        <a href="course_enrollement.php" class="btn btn-primary mt-3">Back to Form</a>
    </div>';
} else {
    echo "<h4 class='text-danger'>Error: " . $stmt->error . "</h4>";
}

$stmt->close();
$conn->close();
?>

            </div>
        </div>
    </div>

<?php include('footer.php'); ?>
</body>
</html>
