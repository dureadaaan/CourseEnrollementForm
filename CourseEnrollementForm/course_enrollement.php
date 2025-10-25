
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$success = false;

if (!isset($_SESSION['logged_In']) || $_SESSION['logged_In'] != "yes") {
    $_SESSION['error'] = true;
    header("Location: login.php");
    exit;
} else {
    $success = true;
}
?>






<html>
<head>
 <title>PHP form</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<style>
  html, body {
    margin: 0;
    padding: 0;
  }
</style>

<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$success=false;

if(!isset($_SESSION['logged_In']) || $_SESSION['logged_In']!="yes"){

$_SESSION['error']=true;
header("Location: login.php");
exit;
}
else {
$success=true;
}
?>


<?php
include 'header.php';
?>
<div class="container text-centered">


<?php if ($success): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <strong>Login successful!</strong>
    </div>
  <?php endif; ?>

<div class="bg-light">
<h1> Course Enrollement Form </h1><br>

<form  action="enrollment_data.php" method="POST" >

<strong>Name:</strong>     <input type = "text" name = "name" placeholder = "enter your name"> <br><br>
<strong> Email:</strong>    <input type = "text" name = "email" placeholder = "enter your email"> <br><br>
<strong> Password: </strong>  <input type = "password" name = "password" placeholder = "enter your password"> <br><br>

<label for="select gender"><strong> Select Gender:</strong> </label><br>
        <input type = "radio" name = "gender" value = "male"> Male<br>
        <input type = "radio" name = "gender" value ="female"> Female<br><br

<label for="department"><strong> Department: </strong></label><br>
        <select name="department">
        <option value="" disabled selected>Select Department</option>
        <option value="CS">Computer Science</option>
        <option value="SE">Software Engineering</option>
        <option value="AI">Artificial Intelligence</option>
        <option value="Cyber">Cybersecurity</option>
       </select><br><br>

<label for="semester"><strong> Semester:</strong> </label><br>
        <select name="semester">
        <option value="" disabled selected>Current Semester</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
       </select><br><br>

<label for="select courses"><strong> Select Courses:</strong> </label><br>
        <input type = "checkbox" name = "courses[]" value="CFP"> <span>CFP</span><br>
        <input type = "checkbox" name = "courses[]" value="OOP"> <span>OOP</span><br>
        <input type = "checkbox" name = "courses[]" value="DLD"> <span>DLD</span><br>
        <input type = "checkbox" name = "courses[]" value="AICT"> <span>AICT</span><br>
        <input type = "checkbox" name = "courses[]" value="LAB"> <span>LAB</span><br><br>

<label for="dob"><strong> Date of Birth:</strong> </label><br>
        <input type="date" name="dob"><br><br>

<label for = "comments"><strong> Comments:</strong> </label></br>
        <textarea name= "comments"></textarea></br><br>

<input type = "submit" >
<a href="logout.php" class="btn btn-danger">Logout</a>


</div>
</div>

</form>

<?php
include 'footer.php';
?>

</body>

</html>