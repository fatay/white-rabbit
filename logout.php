<?php
session_start();
@ob_start();

if(isset($_SESSION['id'])){
    session_destroy();
    header("Location: reglog.php");
}


?>