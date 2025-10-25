<?php
ob_start();
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "course_enrollement";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === "signup") {
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

           if (empty($user_name) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill all fields!";
        header("Location: signup.php");
        exit();
    }

        // Check if email already exists
        $check_sql = "SELECT id FROM sign_in WHERE email = '$email'";
        $result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Email already exists!";
            header("Location: login.php");
            exit();
        }

       
        $insert_sql = "INSERT INTO sign_in (user_name, email, password) VALUES ('$user_name', '$email', '$password')";
        if (mysqli_query($conn, $insert_sql)) {
            $_SESSION['user'] = $email;
            $_SESSION['logged_In'] = "yes";
            header("Location: course_enrollement.php");
            exit();
        } else {
            $_SESSION['error'] = "Signup failed!";
            header("Location: signup.php");
            exit();
        }
    }


    elseif ($action === "login") {
       $email = $_POST['email'];
       $password = $_POST['password'];;

        $login_sql = "SELECT id FROM sign_in WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $login_sql);

        if (mysqli_num_rows($result) === 1) {
            $_SESSION['user'] = $email;
            $_SESSION['logged_In'] = "yes";
            header("Location: course_enrollement.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password!";
            header("Location: login.php");
            exit();
        }
    }
} 

mysqli_close($conn);
ob_end_flush();
?>
