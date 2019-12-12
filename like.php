<?php
@ob_start();
session_start();
if(isset($_SESSION['id'])){
  $giris=true;
  $userid=$_SESSION['id'];
}
else{
  $giris=false;
}

if ($giris==true){
    include_once("connect.php");
    $id = $_REQUEST["id"];
    $begeni = "SELECT * FROM favorites WHERE which_card = '".$id."'AND which_user = '".$userid."'"; 
    $ress = mysqli_query($conn, $begeni);
    if (mysqli_num_rows($ress) > 0) {
        echo "src/img/fav.svg";
        $del = "DELETE FROM favorites WHERE which_card = '".$id."'AND which_user = '".$userid."'";
        $rez = mysqli_query($conn, $del);
    }else{
        echo "src/img/fav_active.svg";
        $add = "INSERT INTO favorites (which_user,which_card)VALUES ('".$userid."','".$id."')";

        $rez = mysqli_query($conn, $add);
    }
}

?>