<?php
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
   
        if(! $conn ) {
           //echo 'Connected failure<br>';
        }
        //echo 'Connected successfully<br>';
        mysqli_select_db($conn, 'white_rabbit' );
        $dil = 'SET NAMES UTF8';
        $result = mysqli_query($conn, $dil);
   
?>