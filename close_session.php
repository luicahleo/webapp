<?php 

session_start();

if(isset($_SESSION['usuarios'])){
    session_destroy();

}

header("Location: index.php");

?>