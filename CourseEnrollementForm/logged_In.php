<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['logged_In'])){

echo "<strong>Sorry! login first</strong>";
exit;
}

if($_SESSION['logged_In']!="yes"){
echo "<strong>log in first</strong>";
exit;
}

else{
echo "<h1>WELCOME</h1> ";

}

?>



